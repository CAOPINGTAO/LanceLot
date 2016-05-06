//预加载上传处理程序
function preLoad() {
	//判断是否加载失败。
	if (!this.support.loading) {
		alert("你需要Flash Player 9.028以上使用SwfUpload。");
		return false;
	}
}

//当页面不能正常加载flash影片的时候触发此函数
function loadFailed() {
	alert("页面加载SwfUpload出现错误！");
}

//当选择文件对话框关闭时，如果选择的文件加入到上传队列中失败，那么针对每个出错的文件都会触发一次该事件
//(此事件和fileQueued事件是二选一触发，文件添加到队列只有两种可能，成功和失败)。
function fileQueueError(file, errorCode, message) {
	try {
		var imageName = "error.gif";
		var errorName = "";
		//超过文件队列数量限制判断
		if (errorCode === SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED) {
			errorName = "您选择图片队列文件太多。";
		}

		if (errorName !== "") {
			alert(errorName);
			return;
		}
		//根据错误号显示对应错误图片
		switch (errorCode) {
			case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE: //文件为零字节
				imageName = "zerobyte.gif";
				break;
			case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT: //超过了上传大小限制
				imageName = "toobig.gif";
				break;
			case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE: //允许外的无效文件类型
			default:
				alert(message);
				break;
		}

		addImage("images/" + imageName); //显示上传错误图片

	} catch (ex) {
		this.debug(ex);
	}

}

//当选择文件对话框关闭，并且所有选择文件已经处理完成（加入上传队列成功或者失败）时，此事件被触发。
//其中numFilesSelected是选择的文件数目，numFilesQueued是此次选择的文件中成功加入队列的文件数目。
function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		//判断是否有文件要上传
		if (numFilesQueued > 0) {
			//开始执行文件上传。startResizedUpload事件处理函数在一个图片开始调整大小时被调用。
			//调整期间不提供progress事件和处理方法。 但是重新编码图片会花费一些时间 。
			//如果这期间出现错误的话 uploadError事件将会被触发
			this.startResizedUpload(this.getFile(0).ID, 450, 450, SWFUpload.RESIZE_ENCODING.JPEG, 100);
			
			//这个事件处理函数可以完成上传前的最后验证以及其他你需要的操作，例如添加、修改、删除post数据等。
			//this.startUpload(this.getFile(0).ID);
		}
	} catch (ex) {
		this.debug(ex);
	}
}

//由flash控件定时触发，提供三个参数分别访问上传文件对象、已上传的字节数，总共的字节数。
//因此可以在这个事件中来定时更新页面中的UI元素，以达到及时显示上传进度的效果。
function uploadProgress(file, bytesLoaded) {

	try {
		var percent = Math.ceil((bytesLoaded / file.size) * 100);

		var progress = new FileProgress(file,  this.customSettings.upload_target);
		progress.setProgress(percent);
		progress.setStatus("Uploading...");
		progress.toggleCancel(true, this);
	} catch (ex) {
		this.debug(ex);
	}
}

//文件上传成功后的处理函数
function uploadSuccess(file, serverData) {
	try {
		var progress = new FileProgress(file,  this.customSettings.upload_target);
		//判断是否图片上传成功（通过响应的前7个字母判断）
		if (serverData.substring(0, 7) === "FILEID:") {
			addImage(serverData.substring(7)); //添加上传成功的图片到页面中

			progress.setStatus("Upload Complete.");
			progress.toggleCancel(false);
		} else {
			addImage("images/error.gif"); //上传失败，添加错误图片
			progress.setStatus("Error.");
			progress.toggleCancel(false);
			alert(serverData);

		}


	} catch (ex) {
		this.debug(ex);
	}
}

//当上传队列中的一个文件完成了一个上传周期，无论是成功(uoloadSuccess触发)还是失败(uploadError触发)，
//uploadComplete事件都会被触发，这也标志着一个文件的上传完成，可以进行下一个文件的上传了。
function uploadComplete(file) {
	try {
		/*  I want the next upload to continue automatically so I'll call startUpload here */
		if (this.getStats().files_queued > 0) {
			//开始执行文件上传。startResizedUpload事件处理函数在一个图片开始调整大小时被调用。
			//调整期间不提供progress事件和处理方法。 但是重新编码图片会花费一些时间 。
			//如果这期间出现错误的话 uploadError事件将会被触发
			this.startResizedUpload(this.getFile(0).ID, 450, 450, SWFUpload.RESIZE_ENCODING.JPEG, 100);
			
			//这个事件处理函数可以完成上传前的最后验证以及其他你需要的操作，例如添加、修改、删除post数据等。
			//this.startUpload(this.getFile(0).ID);
		} else {
			var progress = new FileProgress(file,  this.customSettings.upload_target);
			progress.setComplete();
			progress.setStatus("All images received.");
			progress.toggleCancel(false);
		}
	} catch (ex) {
		this.debug(ex);
	}
}

//无论什么时候，只要上传被终止或者没有成功完成，那么uploadError事件都将被触发
function uploadError(file, errorCode, message) {
	var imageName =  "error.gif";
	var progress;
	try {
		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			try {
				progress = new FileProgress(file,  this.customSettings.upload_target);
				progress.setCancelled();
				progress.setStatus("Cancelled");
				progress.toggleCancel(false);
			}
			catch (ex1) {
				this.debug(ex1);
			}
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			try {
				progress = new FileProgress(file,  this.customSettings.upload_target);
				progress.setCancelled();
				progress.setStatus("Stopped");
				progress.toggleCancel(true);
			}
			catch (ex2) {
				this.debug(ex2);
			}
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			imageName = "uploadlimit.gif";
			break;
		default:
			alert(message);
			break;
		}

		addImage("images/" + imageName);

	} catch (ex3) {
		this.debug(ex3);
	}

}

//将上传的图片添加到页面中
function addImage(filename) {

	var imgdiv = document.createElement("div");
	imgdiv.className = "imgdiv";
	imgdiv.id= filename;
	
	var imgname = document.createElement("input");
	imgname.name = "picname[]";
	imgname.type= "hidden";
	imgname.value = filename;
	
	var divright = document.createElement("div");
	divright.className = "divright";
	
	var picbut = document.createElement("input");
	picbut.type = "button";
	picbut.className = "picdel";
	picbut.value = "删除";
	picbut.id= filename;
	picbut.setAttribute("onclick","dodel(this)");
	
	var picfm = document.createElement("input");
	picfm.type = "radio";
	picfm.name = "cover";
	picfm.value = filename;
	
	var spantext = document.createElement("span");
	spantext.className = "spantext";
	spantext.innerHTML = "设为封面&nbsp;";
	
	var pictextarea = document.createElement("textarea");
	pictextarea.name = "pictext[]";
	pictextarea.rows= "2";
	pictextarea.cols= "60";
	pictextarea.value= "";
	pictextarea.className = "pictextarea";
	
	var newImg = document.createElement("img"); //创建一个img图片节点
	newImg.style.margin = "5px";	//设置间距样式
	
	document.getElementById("thumbnails").appendChild(imgdiv);
	imgdiv.appendChild(newImg);
	imgdiv.appendChild(imgname);
	imgdiv.appendChild(divright); 
	divright.appendChild(picbut);
	divright.appendChild(spantext);
	spantext.appendChild(picfm);
	divright.appendChild(pictextarea);


	
	
	//将图片设置为全透明
	if (newImg.filters) { //为了浏览器兼容
		try {
			newImg.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 0;
		} catch (e) {
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			newImg.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + 0 + ')';
		}
	} else {
		newImg.style.opacity = 0;
	}
	//装载一个load事件，实现图片渐变显示
	newImg.onload = function () {
		fadeIn(newImg, 0);
	};
	newImg.src = __root__+"/Uploads/Photoalbum/Small/s_" + filename; //放置上传后的图片
	newImg.class = "111"; //放置上传后的图片
}

//让指定图片实现渐变显示出来
function fadeIn(element, opacity) {
	var reduceOpacityBy = 5;  //设置渐变值
	var rate = 30;	// 15 fps //设置渐变时间间隔
	//设置透明度
	if (opacity < 100) {
		opacity += reduceOpacityBy; //累加，让图片慢慢显示出来
		if (opacity > 100) {
			opacity = 100;
		}
		//设置图片层的透明度。
		if (element.filters) {
			try {
				element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
			} catch (e) {
				// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
				element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
			}
		} else {
			element.style.opacity = opacity / 100;
		}
	}
	//定时调用自己
	if (opacity < 100) {
		setTimeout(function () {
			fadeIn(element, opacity);
		}, rate);
	}
}



/* ******************************************
 *	FileProgress Object
 *	Control object for displaying file info 显示文件信息的控制对象
 * ****************************************** */

function FileProgress(file, targetID) {
	this.fileProgressID = "divFileProgress";
	this.fileProgressWrapper = document.getElementById(this.fileProgressID);
	if (!this.fileProgressWrapper) {
		this.fileProgressWrapper = document.createElement("div");
		this.fileProgressWrapper.className = "progressWrapper";
		this.fileProgressWrapper.id = this.fileProgressID;

		this.fileProgressElement = document.createElement("div");
		this.fileProgressElement.className = "progressContainer";

		var progressCancel = document.createElement("a");
		progressCancel.className = "progressCancel";
		progressCancel.href = "#";
		progressCancel.style.visibility = "hidden";
		progressCancel.appendChild(document.createTextNode(" "));

		var progressText = document.createElement("div");
		progressText.className = "progressName";
		progressText.appendChild(document.createTextNode(file.name));

		var progressBar = document.createElement("div");
		progressBar.className = "progressBarInProgress";

		var progressStatus = document.createElement("div");
		progressStatus.className = "progressBarStatus";
		progressStatus.innerHTML = "&nbsp;";

		this.fileProgressElement.appendChild(progressCancel);
		this.fileProgressElement.appendChild(progressText);
		this.fileProgressElement.appendChild(progressStatus);
		this.fileProgressElement.appendChild(progressBar);

		this.fileProgressWrapper.appendChild(this.fileProgressElement);

		document.getElementById(targetID).appendChild(this.fileProgressWrapper);
		fadeIn(this.fileProgressWrapper, 0);

	} else {
		this.fileProgressElement = this.fileProgressWrapper.firstChild;
		this.fileProgressElement.childNodes[1].firstChild.nodeValue = file.name;
	}

	this.height = this.fileProgressWrapper.offsetHeight;

}
FileProgress.prototype.setProgress = function (percentage) {
	this.fileProgressElement.className = "progressContainer green";
	this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	this.fileProgressElement.childNodes[3].style.width = percentage + "%";
};
FileProgress.prototype.setComplete = function () {
	this.fileProgressElement.className = "progressContainer blue";
	this.fileProgressElement.childNodes[3].className = "progressBarComplete";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setError = function () {
	this.fileProgressElement.className = "progressContainer red";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setCancelled = function () {
	this.fileProgressElement.className = "progressContainer";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setStatus = function (status) {
	this.fileProgressElement.childNodes[2].innerHTML = status;
};

FileProgress.prototype.toggleCancel = function (show, swfuploadInstance) {
	this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfuploadInstance) {
		var fileID = this.fileProgressID;
		this.fileProgressElement.childNodes[0].onclick = function () {
			swfuploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};
