var current = window.location;
const menuitem=document.querySelectorAll('.nav-link');
const menulenght= menuitem.length;

console.log(current.href)

menuitem.forEach(element => {
    
    if(current.href == element.href){
        element.classList.add('active')
        
    }

});


// for(let i=0;i<menulenght;i++){
//     if(menuitem[i].href === current){
//         menuitem[i].classList.add("active")
//     }

// }