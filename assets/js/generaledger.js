document.addEventListener("DOMContentLoaded", ()=> {
    
    // No future Date
    function noFuture(){
        let currentDate = new Date().toISOString().split('T')[0];

        document.getElementById("fromDate3").setAttribute('max', currentDate);
        document.getElementById("toDate3").setAttribute('max', currentDate);

    }
    noFuture();
    function displayFilterDate(fromDate3, toDate3) {
        console.log('From Date:', fromDate3);
        console.log('To Date:', toDate3);
    
        fetch('search/searchledger.php', {
            method: "POST",
            body: new URLSearchParams({
                fromDate3: fromDate3,
                toDate3: toDate3
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("displayLedger").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    
    document.getElementById('fromDate3').addEventListener('input', () => {
        let fromDate3 = document.getElementById("fromDate3").value;
        let toDate3 = document.getElementById("toDate3").value;
    
        // Check if both dates are not empty
        if (fromDate3 && toDate3) {
            displayFilterDate(fromDate3, toDate3);
        } else {
            displayFilterInit(); // Make sure this function is defined elsewhere
        }
    });
    
    document.getElementById('toDate3').addEventListener('input', () => {
        let toDate3 = document.getElementById("toDate3").value;
        let fromDate3 = document.getElementById("fromDate3").value;

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = toDateValue.getFullYear();
        let month = months[toDateValue.getMonth()];
        const day = toDateValue.getDate();
        document.getElementById("date2").textContent = month + " " + day + ", " + year;

        let link = document.getElementById("printIncome");
        link.href = 'reports/genledger.php?date_to=' + encodeURIComponent(toDate3);
    
        // Check if both dates are not empty
        if (fromDate3 && toDate3) {
            displayFilterDate(fromDate3, toDate3);
        } else {
            displayFilterInit(); // Make sure this function is defined elsewhere
        }
    });
    
    function dynamicOption(){
        fetch('fetch/titles2.php', {
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
            
            document.getElementById("AccTitles").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption();

    function display(){
        document.getElementById('searchLedger').value = "";
        fetch('search/searchledger.php', {
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
            document.getElementById("displayLedger").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    // display();

    function displayC(search){
        fetch('search/searchjournal.php',{
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
            document.getElementById("journalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

        //Keyup Event Listener
        document.getElementById('searchLedger').addEventListener('keyup',(event)=>{
            let data = event.target.value;
            if(data){
                displayC(data);
            } else{
                displayFilterInit();
            }
        })
    
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchledger.php',{
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
            document.getElementById("displayLedger").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

    function displayFilterInit(){
        let fromFilter = document.getElementById("AccTitles").value;
        let disp1 = document.getElementById("disp1");

        disp1.textContent = fromFilter;
        let disp2 = document.getElementById("disp2");
        let fromFilterMain = document.getElementById("AccTitles")
        let selectedOption = fromFilterMain.options[fromFilterMain.selectedIndex];

        let displayed = selectedOption.getAttribute("data-account-code");
        disp2.textContent = displayed;
        
        // Get attribute of selected index of option
        fetch('search/searchledger.php',{
            method: "POST",
            body: new URLSearchParams({
                fromFilter:fromFilter,
            })
            
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            console.log(data);
            document.getElementById("displayLedger").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    setTimeout(()=>{
        displayFilterInit();
    },100)
   

    function displayFilter(fromFilter){

        fetch('search/searchledger.php',{
            method: "POST",
            body: new URLSearchParams({
                fromFilter:fromFilter,
            })
            
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            console.log(data);
            document.getElementById("displayLedger").innerHTML = data;

            let disp2 = document.getElementById("disp2");
            let fromFilterMain = document.getElementById("AccTitles")
            let selectedOption = fromFilterMain.options[fromFilterMain.selectedIndex];

            let displayed = selectedOption.getAttribute("data-account-code");
            disp2.textContent = displayed;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchLedger').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            displayFilterInit();
        }
    })

    document.getElementById('AccTitles').addEventListener('input',(event)=>{
        let fromFilter = event.target.value;
        let disp1 = document.getElementById("disp1");
        disp1.textContent = fromFilter;
        if(fromFilter){
            displayFilter(fromFilter);
        } else {
            displayFilterInit();
        }
    })
})