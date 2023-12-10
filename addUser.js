window.addEventListener('load', ()=>{

    function addUser()
    {
        let fname= document.getElementById("fname").value
        let lname=document.getElementById("lname").value
        let email=document.getElementById("email").value
        let password=document.getElementById("password").value
        let role=document.getElementById("role").value
    
        let dataString='FirstName='+fname+'&LastName='+lname+'&email='+email+'&password='+password+'&Role='+role
        if (!(fname=='' || lname=='' || email==''|| password=='' || role==''))
        {
            $.ajax({
                type: "POST",
                url: "addUser.php",
                data: dataString,
                cache: false,
                success: function(html) {
                    alert(html);
                }
            })
    
        }
        return false
    }
});