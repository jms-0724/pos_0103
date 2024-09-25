document.addEventListener("DOMContentLoaded", ()=> {

    // 
    function display(){
        document.getElementById('searchInfo1').value = "";
        fetch('help/searchhelp.php', {
            method: 'POST',
        })
        //Ensure response is ok
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("helpResults").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }

    //Display Searched Values
    function displaySearch(search){
        fetch('help/searchhelp.php',{
            method: "POST",
            body: new URLSearchParams({
                search:search
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            document.getElementById("helpResults").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchInfo1').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })
}); //End of Document ready

