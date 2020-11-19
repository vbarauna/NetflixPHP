$(document).scroll(function(){
	var foiRolado = $(this).scrollTop() > $(".barraTopo").height();
	$(".barraTopo").toggleClass("scrolled", foiRolado);
})


function desMutar(button){
	var mutado = $(".videoPreview").prop("muted");
	$(".videoPreview").prop("muted", !mutado);

	$(button).find("i").toggleClass("fa-volume-mute");
	$(button).find("i").toggleClass("fa-volume-up");
}

function finalPreview(){
	$(".videoPreview").toggle();
	$(".imagemPreview").toggle();
}

function voltar(){
	window.history.back();
}

function timerEsconderHUD(){
	var timeout = null;

	$(document).on("mousemove", function(){
		clearTimeout(timeout);
		$(".navegacao").fadeIn();

		timeout = setTimeout(function() {
			$(".navegacao").fadeOut();
		}, 1500);
	})
}

function iniVideo(idVideo, nomeUsuario){
	timerEsconderHUD();
	resetInicio(idVideo, nomeUsuario);
	updateTimerProgresso(idVideo, nomeUsuario);
}

function updateTimerProgresso(idVideo, nomeUsuario){
	addDuracao(idVideo, nomeUsuario);

	var timer;

	$("video").on("playing", function(event){
		window.clearInterval(timer);
		timer = window.setInterval(function(){
			updateProgresso(idVideo, nomeUsuario, event.target.currentTime);
		}, 3000)
	})
	.on("ended", function(){
		setTerminado(idVideo, nomeUsuario);
		window.clearInterval(timer);
	})
}

function addDuracao(idVideo, nomeUsuario){
	$.post("ajax/addDuracao.php",{idVideo: idVideo, nomeUsuario: nomeUsuario}, function(data){
		if(data !== null && data !== ""){
			alert(data);
		}
	})
}

function updateProgresso(idVideo, nomeUsuario, progresso){
	$.post("ajax/updateDuracao.php",{idVideo: idVideo, nomeUsuario: nomeUsuario, progresso: progresso}, function(data){
		if(data !== null && data !== ""){
			alert(data);
		}
	})
}

function setTerminado(idVideo, nomeUsuario){
	$.post("ajax/setTerminado.php",{idVideo: idVideo, nomeUsuario: nomeUsuario}, function(data){
		if(data !== null && data !== ""){
			alert(data);
		}
	})
}

function resetInicio(idVideo, nomeUsuario){
	$.post("ajax/getProgresso.php",{idVideo: idVideo, nomeUsuario: nomeUsuario}, function(data){
		if(isNaN(data)){
			alert(data);
			return;
		}

		$("video").on("canplay", function(){
			this.currentTime = data;
			$("video").off("canplay");
		})
	})
}

function resetVideo(){
	$("video")[0].currentTime = 0;
	$("video")[0].play();
	$(".aSeguir").fadeOut();
}

function playVideo(videoId){
	window.location.href = "assistir.php?id=" + videoId;
}

function mostrarASeguir(){
	$(".aSeguir").fadeIn();
}