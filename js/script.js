let el = document.getElementsByClassName("mymodel")[0];
window.addEventListener("click",(e) =>{
    if(e.target.classList.contains("show")){
        e.target.classList.remove("show");
    }   
})
