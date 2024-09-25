document.addEventListener("DOMContentLoaded", ()=> {

    function readyField(){
        let foot1 = document.getElementById("Dr");
            let foot2 = document.getElementById("Cr");
            let value1 = 0.00;
            let value2 = 0.00;
            value1 = parseFloat(value1);
            value1 = value1.toFixed(2);
            value2 = parseFloat(value2);
            value2 = value2.toFixed(2);
            foot1.textContent = value1;
            foot2.textContent = value2;
    }
    readyField();

// Initialize Select2
function initializeSelect2() {
    $('#add_journal_title').select2({
        dropdownParent: $('#createJournals1'),
        placeholder: 'Select an option',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles3.php',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    term: params.term || '',
                    // c_id: $('#add_journal_category').val() || ''
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []
                };
            },
            cache: true
        },
        templateResult: formatOption,
        templateSelection: formatSelection
    });

    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        return $('<span>' + option.text + '</span>' +
            '<span class="custom-attributes" ' +
            'data-account-code="' + option.account_code + '" ' +
            'data-account-type="' + option.account_type + '" ' +
            'data-normal-balance="' + option.normal_balance + '">' +
            '</span>');
    }
    
    function formatSelection(option) {
        if (!option.id) {
            return option.text;
        }
        return option.text;
    }
}

// Event handler for category change
$('#add_journal_category').on('change', function() {

    fetch('fetch/description.php', {
        method: 'POST',
        body: new  URLSearchParams({
            category_id: $(this).val()
        })
    })
    //Ensure response is ok
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        document.getElementById("J_Desc").innerHTML = data;
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
    // $('#add_journal_title').select2('destroy').empty(); // Clear previous data
    // initializeSelect2(); // Reinitialize Select2 with updated category
    
});

// Call the function to initialize Select2 on page load
initializeSelect2();
    
    

    function dynamicOption2(){
        fetch('fetch/category2.php', {
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
            document.getElementById("add_journal_category").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption2();

    function dynamicOption3(){
        fetch('fetch/description.php', {
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
            document.getElementById("J_Desc").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption3();

    function dynamicOption4(){
        fetch('fetch/category2.php', {
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
            document.getElementById("jCategory").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption4();
    
    document.getElementById("saveEntry").addEventListener("click", ()=> {

        let DrSide = document.getElementById("Dr").textContent;
        let DrSideValue = parseFloat(DrSide);
        let dateValue = document.getElementById("add_journal_date").value;
        console.log(DrSide);

        let CrSide = document.getElementById("Cr").textContent;
        let CrSideValue = parseFloat(CrSide);
        console.log(CrSide);

        // let tables = document.querySelector("#journalBody");
        // let rows = tables.querySelectorAll("tr");
        // let values = [];
        // let duplicates = [];

        // rows.forEach(row => {
        //     let cellText = row.querySelector("td").textContent.trim();
            
        //     if (values.includes(cellText)) {
        //         duplicates.push(cellText);
        //     } else {
        //         values.push(cellText);
        //     }
        // });

        if (DrSideValue === 0.00 || CrSideValue === 0.00){
            $("#failed2").modal('show');
        }
        else if (DrSideValue != CrSideValue){
            $("#failed3").modal('show');
        } else if (dateValue = "" || dateValue === null) {
            $("#failed4").modal('show');
         } //else if (duplicates.length > 0){
        //     $("#failed5").modal('show');
        // }
        else {
            $("#confirmEntry").modal("show");
            $("#createJournals1").modal("hide");
        }
        
    })
    document.getElementById("backAdd").addEventListener("click", ()=> {
        $("#confirmEntry").modal("hide");
        $("#createJournals1").modal("show");
    })
    // Adds Journal Data to database
    document.getElementById("proceedAdd").addEventListener("click", ()=> {
        let add_journal_date = document.getElementById("add_journal_date").value;
        let add_journal_number = document.getElementById("add_journal_number").value;
        let add_journal_description = document.getElementById("add_journal_description").value;
        let add_journal_category = document.getElementById("add_journal_category").value;
        let arrayData = [];

        let journal_rows = document.querySelectorAll(".journal_items");

        journal_rows.forEach(row => {
            let account_code = row.getElementsByTagName("td")[1].getAttribute("id");
            let journal_debit = row.getElementsByTagName("td")[2].textContent;
            let journal_debit_main = row.getElementsByTagName("td")[2];
            let journal_credit = row.getElementsByTagName("td")[3].textContent;
            let journal_credit_main = row.getElementsByTagName("td")[3];

            if (journal_debit === ""){
                let amount = journal_credit;
                let placement = journal_credit_main.getAttribute("class");
                arrayData.push({
                    account_code: account_code,
                    journal_amount: amount,
                    journal_placement:placement
                })
            } else if(journal_credit === "") {
                let amount = journal_debit;
                let placement = journal_debit_main.getAttribute("class");
                arrayData.push({
                    account_code: account_code,
                    journal_amount: amount,
                    journal_placement:placement
                })
            }

            
        })
        console.log(arrayData);
        let sendtoDB = {
            add_journal_date:add_journal_date,
            add_journal_number:add_journal_number,
            add_journal_description:add_journal_description,
            add_journal_category:add_journal_category,
            journal_array:arrayData,
        }
        console.log(sendtoDB);

        fetch("add/addjournal.php", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body:JSON.stringify(sendtoDB),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=> {
            // Logs Data Recieved
            console.log(data);
            if(data === "Success"){
                let journalTable = document.getElementById("journalBody");
                $("#success1").modal("show");
                $("#confirmEntry").modal("hide");

                document.getElementById("add_journal_description").value = "";
                document.getElementById("add_journal_category").value = "";

                document.getElementById("addJournalEntryForm2").reset;
                while(journalTable.firstChild){
                    journalTable.removeChild(journalTable.firstChild);
                }
                display();
                calculateTotal();
                setTimeout( ()=>{
                    JEVNumber();
                },1000)
                function readOnlyRemove(){
                    
                    document.getElementById("add_journal_category").readOnly = false;
                    document.getElementById("add_journal_description").readOnly = false;
        
                }
                readOnlyRemove();
                window.open("reports/jevprint.php","_blank");

            } else {
                console.log();
                $("#failed1").modal("show");
                document.getElementById("error1").textContent = data;
                
            }
        })

    })
     function currentDate(){
        const date = new Date();
        const formattedDate = date.toISOString().split('T')[0];
        document.getElementById("fromDate").value = formattedDate;
     }
     currentDate();
     function JEVNumber() {
        const date = new Date();
        const yearLast = date.getFullYear().toString().slice(-2);
        const hyphen = "-";
        let autoincrementvalue;
        let journalbody = document.getElementById("journalList");
        
        if (!journalbody || journalbody.querySelector('td[colspan="5"]') ) {
            // No records found, set the initial value to "0001"
            const JEVNumber = yearLast + hyphen + "0001";
            document.getElementById('add_journal_number').value = JEVNumber;
            
            // Add event listener for button click
            document.getElementById('addJEV').addEventListener("click", () => {
                let JEVValue = document.getElementById("add_journal_number").value;
                console.log(JEVValue);  // Log the generated JEV number
            });
            
            return;  // Stop further execution since there are no records
        } else {
            let highestNumber = 0;
    
            // Iterate through each row to find the highest journal number
            Array.from(journalbody.children).forEach(row => {
                let pastvalue = row.getElementsByTagName("td")[1].textContent;
                let pastNumber = parseInt(pastvalue.substring(3, 7));
                if (pastNumber > highestNumber) {
                    highestNumber = pastNumber;
                }
            });
    
            autoincrementvalue = highestNumber + 1;
            let formattedNumber = autoincrementvalue.toString().padStart(4, '0');
            let JEVNumber = yearLast + hyphen + formattedNumber;
    
            // Set the generated JEV number in the input field
            document.getElementById('add_journal_number').value = JEVNumber;
    
            // Add event listener for button click
            document.getElementById('addJEV').addEventListener("click", () => {
                let JEVValue = document.getElementById("add_journal_number").value;
                console.log(JEVValue);
            });
        }
    }
    
    
      setTimeout(function() {
         JEVNumber();
        }, 1000)
     

    function display(){
        document.getElementById('searchJournal').value = "";
        fetch('search/searchjournal.php', {
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
            document.getElementById("journalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
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

    function displayC(titleAcc){
        fetch('search/journalfilter2.php',{
            method: "POST",
            body: new URLSearchParams({
                titleAcc:titleAcc
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
            document.getElementById("journalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

        // No future Date
        function noFuture(){
            let currentDate = new Date().toISOString().split('T')[0];
    
            document.getElementById("fromDate").setAttribute('max', currentDate);
            document.getElementById("toDate").setAttribute('max', currentDate);
            document.getElementById("add_journal_date").setAttribute('max', currentDate);
    
        }
        noFuture();
            //Keyup Event Listener 2
            document.getElementById('jCategory').addEventListener('input',(event)=>{
                let data = event.target.value;
                if(data){
                    displayC(data);
                } else{
                    display();
                }
            })
    function displayFilter(fromDate, toDate){
        console.log(fromDate, toDate);
        fetch('search/journalfilter.php',{
            method: "POST",
            body: new URLSearchParams({
                fromDate:fromDate,
                toDate:toDate
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
    document.getElementById('searchJournal').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })
    document.getElementById('fromDate').addEventListener('input',(event)=>{
        let fromDate = event.target.value;
        let toDate = document.getElementById("toDate").value;
        if(fromDate || toDate){
            displayFilter(fromDate, toDate);
        } else {
            display();
        }
    })
    document.getElementById('toDate').addEventListener('input',(event)=>{
        let toDate = event.target.value;
        let fromDate = document.getElementById("fromDate").value;
        if(fromDate || toDate){
            displayFilter(fromDate, toDate);
        } else {
            display();
        }
    })
    // document.getElementById("nextJItems").addEventListener("click", ()=> {
    //     const jevNumber = document.getElementById("add_journal_number").value;
    //     const jevDescription = document.getElementById("add_journal_description").value;
    //     const jevCategory = document.getElementById("add_journal_category").value;
    //     if(jevNumber === "" || jevDescription === "" || jevCategory === "") {
    //         alert("Please Complete The Required Values");
    //     } else {  
    //         $("#createJournals1").modal("hide");
    //         $("#createJournals2").modal("show");

    //         // Set Default Values
    //         let foot1 = document.getElementById("Dr");
    //         let foot2 = document.getElementById("Cr");
    //         let value1 = 0.00;
    //         let value2 = 0.00;
    //         value1 = parseFloat(value1);
    //         value1 = value1.toFixed(2);
    //         value2 = parseFloat(value2);
    //         value2 = value2.toFixed(2);
    //         foot1.textContent = value1;
    //         foot2.textContent = value2;
    //     }
    // })
    // For Normal Balance
    document.getElementById("addJEntry").addEventListener("click", ()=> {
        const field1 = document.getElementById("add_journal_title"); 
        const field2 = document.getElementById("add_journal_amount");
        if (field1.value === "" || field2.value === ""){
            $("#failed4").modal("show");
        } else {
            let journalTable = document.getElementById("journalBody");
            let accountTitle = $('#add_journal_title').select2('data')[0];
        let accountTitleValue = accountTitle.text.trim();
        let amount = document.getElementById("add_journal_amount").value.trim(); 
        let amountDecimal = parseFloat(amount).toFixed(2);
        let accountTitleId = accountTitle.id;
        
        // let category = document.getElementById("add_journal_category").value.trim(); 

        // let selectedOption = document.querySelector(`#add_journal_title option[value="${accountTitle.id}"]`);
        let normal = accountTitle.normal_balance;
        let account_code = accountTitle.account_code;

        let newRow = journalTable.insertRow();
        newRow.setAttribute("class", "journal_items");
             let cell0 = newRow.insertCell(0)
             let cell1 = newRow.insertCell(1);
             let cell2 = newRow.insertCell(2);
             let cell3 = newRow.insertCell(3);
             let cell4 = newRow.insertCell(4);
             
            
             cell0.textContent = accountTitleId;
             cell1.textContent = accountTitleValue;
             cell1.setAttribute("id", account_code);
            //  Element Creation
            // let button2 = document.createElement('button');
            let editButton = document.createElement('button');
            let removeButton = document.createElement('button');
            editButton.textContent = "Edit";
            removeButton.textContent = "Remove";
            editButton.classList.add("btn", "btn-secondary", "text-white", "editRow", );
            removeButton.classList.add("btn", "btn-danger", "text-white", "deleteRow");
            
            // Append to CELL4
            cell4.appendChild(editButton);
            cell4.appendChild(removeButton);

            editButton.style.marginRight = "5px";
            editButton.style.backgroundColor = "#004d68";
            removeButton.style.backgroundColor = "#004d68";
            // let dropdown_div = document.createElement('div');
            // let dropdown_ul = document.createElement('ul');
            // //  Array for Iteration 
            // let items = ['Edit', 'Remove'];
            //     items.forEach((list, index) => {
            //         const li = document.createElement("li");        
            //         const a_link = document.createElement("a");
            //         a_link.textContent = list;
            //         a_link.classList.add("dropdown-item");
            //         if (list === 'Edit'){
            //             a_link.classList.add("editRow");
            //         } else if (list === 'Remove') {
            //             a_link.classList.add("deleteRow")
            //         }
            //         li.append(a_link);
            //         dropdown_ul.append(li);  
            //     })
            // //  Declare Attributes
            // dropdown_div.classList.add("dropdown")
            // dropdown_ul.classList.add("dropdown-menu");
            // button2.classList.add("btn","btn-secondary", "dropdown-toggle");
            // button2.textContent = "Actions";
                       
            // button2.setAttribute("data-bs-toggle", "dropdown");
                        
            // dropdown_div.append(button2,dropdown_ul);
                        
            // cell4.appendChild(dropdown_div);
             if (normal === "Credit"){
                cell3.textContent = amountDecimal;
                cell3.setAttribute("class",normal);
                cell3.setAttribute("data-value",amountDecimal);

             } else {
                cell2.textContent = amountDecimal;
                cell2.setAttribute("class",normal);
                cell2.setAttribute("data-value",amountDecimal);

                
             }

            //  Debit
            // cell2.textContent = amountDecimal;
            // cell2.setAttribute("class",normal);
            // cell2.setAttribute("data-value",amountDecimal);
            document.getElementById("addJournalEntryForm2").reset();
            $('#add_journal_title').val(null).trigger('change');
            //  For Removal
            let deleteButtons = document.querySelectorAll('.deleteRow');

            deleteButtons.forEach(button => {
              button.addEventListener('click', function(event) {
                let row = event.target.parentNode;
                while (row.tagName !== 'TR') {
                  row = row.parentNode;
                }
                row.parentNode.removeChild(row);
                calculateTotal();
              });
            });
             
                 let editButtons = document.querySelectorAll('.editRow');
                 editButtons.forEach(editButton => {
                     editButton.addEventListener('click', function(event){
                         // Evenet Delegation
                         let row = event.target.closest('tr');
                         let debit = row.querySelector(".Debit");
                         let credit = row.querySelector(".Credit");
                         let JEVamount;
                         

                        console.log(row);
                        console.log(debit, credit);
                         if(debit === null) {
                             JEVamount = cell3.textContent;
                             document.getElementById("jevAmount").value = JEVamount
                             document.getElementById("jevAmount").setAttribute("data-bs-entry", "Credit");
                         } else if (credit === null ){
                              JEVamount = cell2.textContent;
                              
                              document.getElementById("jevAmount").value = JEVamount
                              document.getElementById("jevAmount").setAttribute("data-bs-entry", "Debit");
                         }
                         if(event.target.classList.contains('editRow')){
                             $("#editEntry").modal("show");   
                             $("#createJournals1").modal("hide");
                         }

                         const saveEditHandler = () => {
                            let JEVamount = document.getElementById("jevAmount").value;
                            let placement = document.getElementById("jevAmount").getAttribute("data-bs-entry");
                
                            console.log(row);
                            if (placement === "Debit") {
                                debit.textContent = JEVamount;
                                console.log(JEVamount);
                            } else if (placement === "Credit" && debit === null) {
                                console.log(credit.textContent);
                                credit.textContent = JEVamount;
                                console.log(JEVamount);
                            }
                
                            $("#editEntry").modal("hide");
                            $("#createJournals1").modal("show");
                            calculateTotal();
                        };
                        document.getElementById("saveEdit").removeEventListener("click", saveEditHandler);
                        document.getElementById("saveEdit").addEventListener("click", saveEditHandler);
                        
                     });
                 })
                 
                 calculateTotal();
                 
        }
        function readOnly(){
            document.getElementById("add_journal_number").readOnly = true;
            document.getElementById("add_journal_category").readOnly = true;
            document.getElementById("add_journal_description").readOnly = true;

        }
        readOnly();
        
                 
    })
    // Calculate Total
    function calculateTotal(){
        let foot1 = document.getElementById("Dr");
        let foot2 = document.getElementById("Cr");
        let journalTable = document.getElementById("journalBody");
        let rows = journalTable.getElementsByClassName("journal_items");
        let totalDebit = 0;
        let totalCredit = 0;

        Array.from(rows).forEach(row=> {
            let debit = row.querySelector(".Debit");
            let credit = row.querySelector(".Credit");

            if(debit){
                totalDebit += parseFloat(debit.textContent);
            } else if(credit){
                totalCredit += parseFloat(credit.textContent);
            } 
        })

        foot1.textContent = totalDebit.toFixed(2);
        foot2.textContent = totalCredit.toFixed(2);
    }

    document.getElementById("addJEntry2").addEventListener("click", ()=> {
        const field1 = document.getElementById("add_journal_title"); 
        const field2 = document.getElementById("add_journal_amount");
        if (field1.value === "" || field2.value === ""){
            $("#failed4").modal("show");
        } else {
            let journalTable = document.getElementById("journalBody");
            let accountTitle = $('#add_journal_title').select2('data')[0];
        let accountTitleValue = accountTitle.text.trim();
        let amount = document.getElementById("add_journal_amount").value.trim(); 
        let amountDecimal = parseFloat(amount).toFixed(2);
        let accountTitleId = accountTitle.id;
        
        // let category = document.getElementById("add_journal_category").value.trim(); 

        // let selectedOption = document.querySelector(`#add_journal_title option[value="${accountTitle.id}"]`);
        let normal = accountTitle.normal_balance;
        let account_code = accountTitle.account_code;

        let newRow = journalTable.insertRow();
        newRow.setAttribute("class", "journal_items");
             let cell0 = newRow.insertCell(0)
             let cell1 = newRow.insertCell(1);
             let cell2 = newRow.insertCell(2);
             let cell3 = newRow.insertCell(3);
             let cell4 = newRow.insertCell(4);
             
            
             cell0.textContent = accountTitleId;
             cell1.textContent = accountTitleValue;
             cell1.setAttribute("id", account_code);
            //  Element Creation
            //  let button2 = document.createElement('button');
             let editButton = document.createElement('button');
            let removeButton = document.createElement('button');
            editButton.textContent = "Edit";
            removeButton.textContent = "Remove";
            editButton.classList.add("btn", "btn-secondary", "text-white", "editRow", );
            removeButton.classList.add("btn", "btn-danger", "text-white", "deleteRow");
            
            // Append to CELL4
            cell4.appendChild(editButton);
            cell4.appendChild(removeButton);

            editButton.style.marginRight = "5px";
            editButton.style.backgroundColor = "#004d68";
            removeButton.style.backgroundColor = "#004d68";
            // //  Array for Iteration 
            //  let items = ['Edit', 'Remove'];
            //  items.forEach((list, index) => {
            //     const li = document.createElement("li");
                
            //     const a_link = document.createElement("a");
                
            //     a_link.textContent = list;
            //     a_link.classList.add("dropdown-item");
            //     if (list === 'Edit'){
            //         a_link.classList.add("editRow");
            //     } else if (list === 'Remove') {
            //         a_link.classList.add("deleteRow")
            //     }
            //     li.append(a_link);
            //     dropdown_ul.append(li);  
            // })
            // //  Declare Attributes
            // dropdown_div.classList.add("dropdown")
            // dropdown_ul.classList.add("dropdown-menu");
            // button2.classList.add("btn","btn-secondary", "dropdown-toggle");
            // button2.textContent = "Actions";
           
            // button2.setAttribute("data-bs-toggle", "dropdown");
            
            // dropdown_div.append(button2,dropdown_ul);
            // // button.classList.add('editRow', 'btn', 'btn-primary');
            // // button.textContent = "Edit"
            //  cell4.appendChild(dropdown_div);
             if (normal === "Credit"){
                cell2.textContent = amountDecimal;
                cell2.setAttribute("class","Debit");
                cell2.setAttribute("data-value",amountDecimal);

             } else {
                cell3.textContent = amountDecimal;
                cell3.setAttribute("class","Credit");
                cell3.setAttribute("data-value",amountDecimal);
                
             }

            //  Credit Field is Filled
            cell3.textContent = amountDecimal;
            cell3.setAttribute("class","Credit");
            cell3.setAttribute("data-value",amountDecimal);
            
             $('#add_journal_title').val(null).trigger('change');
             document.getElementById("addJournalEntryForm2").reset();
            //  For Removal
            let deleteButtons = document.querySelectorAll('.deleteRow');

            deleteButtons.forEach(button => {
              button.addEventListener('click', function(event) {
                let row = event.target.parentNode;
                while (row.tagName !== 'TR') {
                  row = row.parentNode;
                }
                row.parentNode.removeChild(row);
                calculateTotal();
              });
            });
                

                let editButtons = document.querySelectorAll('.editRow');
                editButtons.forEach(editButton => {
                    editButton.addEventListener('click', function(event){
                        // Evenet Delegation
                        let row = event.target.closest('tr');
                        let debit = row.querySelector(".Debit");
                        let credit = row.querySelector(".Credit");
                        console.log(debit, credit);
                        let JEVamount = "";
                        if (debit === null) {
                            JEVamount = cell3.textContent;
                            document.getElementById("jevAmount").value = JEVamount;
                            document.getElementById("jevAmount").setAttribute("data-bs-entry", "Credit");
                        } else if (credit === null) {
                            JEVamount = cell2.textContent;
                            document.getElementById("jevAmount").value = JEVamount;
                            document.getElementById("jevAmount").setAttribute("data-bs-entry", "Debit");
                        }
                        if(event.target.classList.contains('editRow')){
                            $("#editEntry").modal("show");
                            $("#createJournals1").modal("hide");
                        }
                        const saveEditHandler = () => {
                            let JEVamount = document.getElementById("jevAmount").value;
                            let placement = document.getElementById("jevAmount").getAttribute("data-bs-entry");
                
                            console.log(row);
                            if (placement === "Debit") {
                                debit.textContent = JEVamount;
                                console.log(JEVamount);
                            } else if (placement === "Credit" && debit === null) {
                                console.log(credit.textContent);
                                credit.textContent = JEVamount;
                                console.log(JEVamount);
                            }
                
                            $("#editEntry").modal("hide");
                            $("#createJournals1").modal("show");
                            calculateTotal();
                        };
                        document.getElementById("saveEdit").removeEventListener("click", saveEditHandler);
                        document.getElementById("saveEdit").addEventListener("click", saveEditHandler);
                    });
                    
                })


                calculateTotal(); 
        }
        function readOnly(){
            document.getElementById("add_journal_number").readOnly = true;
            document.getElementById("add_journal_category").readOnly = true;
            document.getElementById("add_journal_description").readOnly = true;

        }
        readOnly();
    })


  
})
function calculateTotal2(){
    let foot1 = document.getElementById("Dr2");
    let foot2 = document.getElementById("Cr2");
    let journalTable = document.getElementById("viewJTable");
    let rows = journalTable.getElementsByClassName("jItems");
    let totalDebit = 0;
    let totalCredit = 0;

    Array.from(rows).forEach(row=> {
        let debit = row.querySelector(".Debit");
        let credit = row.querySelector(".Credit");

        if(debit){
            totalDebit += parseFloat(debit.textContent);
        } else if(credit){
            totalCredit += parseFloat(credit.textContent);
        } 
    })

    foot1.textContent = totalDebit.toFixed(2);
    foot2.textContent = totalCredit.toFixed(2);
}
function viewEntry(uid){
    fetch('fetch/fetchjournal.php',{
        method: 'POST',
        headers: {'Content-type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            uid: uid
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP-Error: " + response.status);
        } 
        return response.text();
    })
    .then(data => {
        $("#viewEntry").modal('show');
        document.getElementById("viewJTable").innerHTML = data
        let foot1 = document.getElementById("Dr2");
        let foot2 = document.getElementById("Cr2");
        let value1 = 0.00;
        let value2 = 0.00;
        value1 = parseFloat(value1);
        value1 = value1.toFixed(2);
        value2 = parseFloat(value2);
        value2 = value2.toFixed(2);
        foot1.textContent = value1;
        foot2.textContent = value2;
        calculateTotal2();

        
        return fetch('search/searchjev.php', {
            method:'POST',
            headers: {'Content-type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({
                uid: uid,
            })
        });
    })
    .then(response2 => {
        if (!response2.ok) {
            throw new Error("HTTP-Error: " + response.status);
        } 
        return response2.text();
    })
    .then(data2 =>{
        let tbl_jev = JSON.parse(data2);
        console.log(data2);
        document.getElementById("jevNum").textContent = tbl_jev.journal_voucher_no;
        document.getElementById("jevDate").textContent = tbl_jev.journal_date;
        document.getElementById("jevType").textContent = tbl_jev.category_name;

        document.getElementById("printJEV1").href = `reports/jevvoucher.php?voucher_id=${tbl_jev.journal_voucher_id}`;
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }

  