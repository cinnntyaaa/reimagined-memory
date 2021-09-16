<!-- <h2>Sound: wav</h2> -->
<audio><source src="sound/sound.wav"></source></audio>

<script>
//	init
var wrequest;
window.onload = function(){
	try{ wrequest = setInterval(function(){ srequest(); },30000); }catch(e){ console.log(e); clearInterval(wrequest); }
};

//	ajax
function srequest(){
	var xmlhttp;
	var param = 4;
	if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			try{
				let outp = JSON.parse(xmlhttp.responseText);
				let result = (Number(outp[0].memobeli) + Number(outp[0].memomaint));
				//	check is playable?
				result>0?playsound():nosound();
			}catch(e){
				console.log(e);
				alert("Fail to fetch...! Please relogin.");
				clearInterval(wrequest);
			}
		}
	}
	xmlhttp.onerror=function(){		
		try{
			alert("Network Error...! Please reload your Browser.");
			clearInterval(wrequest);
		}catch(e){
			console.log(e);
		}
	}
	
	xmlhttp.open("POST","datafetcher.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("x="+param);
}

//	player
function playsound(){
	audio = document.getElementsByTagName("audio")[0];
	audio.play();
}

function nosound(){}
</script>
