function showpass(){
  let type = document.getElementById("senha")
  let img = document.getElementById("imgeye")
  // img.className = ''
  
  if(type.type == 'password') {
      type.type = 'text'
      // img.className = 'bi bi-eye-slash'
    } else {
      type.type = 'password'
      // img.className = 'bi bi-eye'
    
  }
}