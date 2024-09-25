document.addEventListener("DOMContentLoaded", ()=> {

    // function hideButton() {
    //     let button = document.getElementById("addtrial");
    
    //     // Get the current year properly
    //     let year = new Date().getFullYear();
    
    //     // Use correct string interpolation in template literals
    //     let start = new Date(`${year}-12-01`);
    //     let end = new Date(`${year}-12-31`);
    //     let today = new Date();
    
    //     // Show the button if today is within the range
    //     if (today >= start && today <= end) {
    //         button.style.display = 'block';
    //     } else {
    //         button.style.display = 'none';
    //     }
    // }
    
    // hideButton();
    
    // Max Date
    function noFuture(){
        let currentDate = new Date().toISOString().split('T')[0];

        document.getElementById("fromDate2").setAttribute('max', currentDate);
        document.getElementById("toDate2").setAttribute('max', currentDate);

    }
    noFuture();
    // Select JS
    $('#add_journal_title2').select2({
        dropdownParent: $('#addTrial'),
        placeholder: 'Select an option',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles2.php', // Replace with the path to your PHP script
            dataType: 'json',
            delay: 250, // Delay in milliseconds between keystrokes and when the request is sent
            data: function(params) {
                return {
                    term: params.term // Search term
                };
            },
            processResults: function(data) {
                return {
                    results: data // The data needs to be in an array of objects with 'id' and 'text' keys
                };
            },
            cache: true
        }
    });
    function display(){
        document.getElementById('searchTrial').value = "";
        fetch('search/searchtrial.php', {
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
            document.getElementById("displayTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchtrial.php',{
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
            document.getElementById("displayTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchTrial').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })

    document.getElementById("addTrialForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#confirmTrial").modal('show');
        $("#addTrial").modal('hide');
    })
    document.getElementById("backAddTrial").addEventListener("click", ()=> {
        $("#confirmTrial").modal('hide');
        $("#addTrial").modal('show');
    })

    document.getElementById("proceedAddTrial").addEventListener("click", ()=> {
    
        let add_journal_title2 = document.getElementById("add_journal_title2").value;
        let add_balance_type = document.getElementById("add_balance_type").value;
        let add_start_balance = document.getElementById("add_start_balance").value;
    
        fetch('add/addtrial.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                add_journal_title2:add_journal_title2,
                add_balance_type:add_balance_type,
                add_start_balance:add_start_balance
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            if(data = "Success"){
                $("#success").modal('show');
                $("#confirmTrial").modal('hide');
                document.getElementById("addTrialForm").reset();
                displayFilter();
            } else if (data = "Failed"){
                $("#failed6").modal('show');
                $("#confirmAdd").modal('hide');
            } else if (data = "No Statement Prepared") {
                $("#failed5").modal('show');
                $("#confirmAdd").modal('hide');
            }  else {
                $("#failed").modal('show');
                $("#confirmAdd").modal('hide');
            }
        })
    });
    // Current Date
    function currentDate(){
        const date = new Date();
        const formattedDate = date.toISOString().split('T')[0];
        document.getElementById("toDate2").value = formattedDate;

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = date.getFullYear();
        let month = months[date.getMonth()];
        const day = date.getDate();
        document.getElementById("date2").textContent = month + " " + day + ", " + year
     }
     currentDate();

     function pastDate(){
        const date = new Date();
        const oneweek = new Date();
        oneweek.setDate(date.getDate()-7);
        const formattedDate = oneweek.toISOString().split('T')[0];
        document.getElementById("fromDate2").value = formattedDate;

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = oneweek.getFullYear();
        let month = months[oneweek.getMonth()];
        const day = oneweek.getDate();
        document.getElementById("date1").textContent = month + " " + day + ", " + year
     }
     pastDate();
    //  Filter Based on Date
    function displayFilter(fromDate2, toDate2){
        console.log(fromDate2, toDate2);
        fetch('search/searchtrial.php',{
            method: "POST",
            body: new URLSearchParams({
                fromDate2:fromDate2,
                toDate2:toDate2
            })
            
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            document.getElementById("displayTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

    document.getElementById('fromDate2').addEventListener('input',(event)=>{
        let fromDate2 = event.target.value;
        let fromDateValue = new Date(fromDate2);
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = fromDateValue.getFullYear();
        let month = months[fromDateValue.getMonth()];
        const day = fromDateValue.getDate();
        document.getElementById("date1").textContent = month + " " + day + ", " + year;
        let toDate2 = document.getElementById("toDate2").value;
        if(fromDate2 || toDate2){
            displayFilter(fromDate2, toDate2);
        } else {
            display();
        }
    })
    document.getElementById('toDate2').addEventListener('input',(event)=>{
        let toDate2 = event.target.value;
        let toDateValue = new Date(toDate2);
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = toDateValue.getFullYear();
        let month = months[toDateValue.getMonth()];
        const day = toDateValue.getDate();
        document.getElementById("date2").textContent = month + " " + day + ", " + year;

        let link = document.getElementById("printIncome");
        link.href = 'reports/incomestatement.php?date_to=' + encodeURIComponent(toDate2);

        let fromDate2 = document.getElementById("fromDate2").value;
        if(fromDate2 || toDate2){
            displayFilter(fromDate2, toDate2);
        } else {
            display();
        }
    })




})