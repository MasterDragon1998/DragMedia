var loginPanel;
window.onload = function(){
	loginPanel = document.getElementById("loginPanel");
	loginPanel.open = function(){
		this.style.display = "block";
	}
	loginPanel.close = function(){
		this.style.display = "none";
	}
	loginPanel.toggle = function(){
		if(this.style.display=="block"){
			this.style.display = "none";
		}else{
			this.style.display = "block";
		}
	}
}