window.addEventListener("load", ()=>{

        const fname=document.querySelector("#fname")
        const lname=document.querySelector("#lname")
        const email=document.querySelector("#email")
        const password=document.querySelector("#password")
        
        role=document.querySelector("#role")
        roleSelected=role.value
        
        const AddUserBtn=document.querySelector("#AddUser")
    
            AddUserBtn.addEventListener("click", (e)=>{
                alert("User has been sucessfully created")
                fetch('addUser.php', {
                    method: 'POST',
                    headers: {'Content-Type':'application/x-www-form-urlencoded'},
                    body: `fname=${fname}&lname=${lname}&email=${email}&password=${password}&role=${roleSelected}`
                })
                .then(response => {
                    if(response.ok){return response.text()}
                    else{return Promise.reject('Something was wrong with the request!')}
                })
                .then(data => {
                    console.log(data)
                })
            })       
});