/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
document.getElementById('myform').addEventListener('submit', function (event) {
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var password1 = document.getElementById('password1').value;
    if(password !== password1)
    {
        alert('Password is not the same!');
        event.preventDefault(); // Prevent form submission
    };
    if(firstname===null||firstname==='' &&lastname===null||lastname ===''&&email===null||email===''&&password===null||password===''&&password1===null||password1==='' ){
      alert('Informationen are not 100% given!');
       event.preventDefault();  
    }
    /* if(lastname===null||lastname ==='' ){
      alert('Lastname is not given!');
       event.preventDefault();  
    }
     if(email===null||email==='' ){
      alert('Email is not given!');
       event.preventDefault();  
    }
    if(password===null||password==='' ){
      alert('Password is not given!');
       event.preventDefault();  
    }
     if(password1===null||password1==='' ){
      alert('Password is not repeated!');
       event.preventDefault();  
    }*/
    
});

