document.addEventListener('DOMContentLoaded', () =>{

    let assigntome = document.querySelector("#assign");
    let switchbtn = document.querySelector("#switch");
    let addNoteBtn = document.querySelector("#addNote");
    let id = addNoteBtn.classList;
    let noteInput = document.querySelector("textarea");

    assigntome.addEventListener('click', function(element) {
        element.preventDefault();
        fetch(`viewcontactFunction.php?assign=${id}`)
        .then(response => {
            if (response.ok){
                return response.text()
            }else {
                return Promise.reject('something went wrong')
            }
        })
        .then(data => {
            var arr = data.split(',');
            alert("You " + arr[0] + " are now assigned to this contact")
            document.querySelector("#assigned").value = arr[0];
            document.getElementById('updatedInfo').innerHTML = 'Updated on ' + arr[1];
        })
        .catch(error => console.log('There was an error' + error));
    })


    switchbtn.addEventListener('click', function(element) {
        element.preventDefault();

        let newType;
        if(switchbtn.innerText.includes('Sales')){
            newType = "Sales Lead"
            switchbtn.innerHTML = "<span class=\"material-symbols-outlined\">switches</span>Switch to Support"
        }
        else if(switchbtn.innerText.includes('Sup')){
            newType = "Support"
            switchbtn.innerHTML = "<span class=\"material-symbols-outlined\">switches</span></i>Switch to Sales Lead"
        }
        

        fetch(`viewcontactFunction.php?switch=${id}&to=${newType}`)
        .then(response => {
            if (response.ok){
                return response.text()
            }else {
                return Promise.reject('something went wrong')
            }
        })
        .then(data => {
            var arr = data.split(',')
            document.getElementById('updatedInfo').innerHTML = 'Updated on ' + arr[1];
            
        })
        .catch(error => console.log('There was an error' + error));

        
    })

    addNoteBtn.addEventListener('click', (e) => {
        e.preventDefault()

        fetch("viewcontactFunction.php", {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `comment=${noteInput.value}&id=${id}`
        })
        .then(response => {
            if (response.ok){
                return response.text()
            }else {
                return Promise.reject('something went wrong')
            }
        })
        .then(data => {
            document.querySelector(".w-notes").innerHTML += data
            document.getElementById('editnotes').value = '';
        })
        .catch(error => console.log('There was an error' + error));
    })

    

})