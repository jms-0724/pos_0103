<!-- Add Trial Modal Titles -->
<div class="modal fade" id="addAccounts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account Titles</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addAccountForm">
                <div class="form-group mb-2">
                <label for="account_journal_title" class="form-label">Account Titles</label>
                    <select name="account_journal_title" id="add_journal_title2" class="form-select" required>
                      
                    </select>  
                </div>
                <div class="form-group mb-2">
                    <label for="account_title" class="form-label">Balance Type</label>
                    <select name="" id="add_balance_type">
                        <option value="Debit">Debit</option>
                        <option value="Credit">Credit</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                   <label for="add_account_type">Amount</label>
                   <input type="text" class="form-control" id="add_start_balance">
                </div>
                <!-- <div class="form-group mb-2">
                   <label for="add_account_type">Account Class</label>
                   <select name="add_account_class" id="add_account_class" class="form-select">

                   </select>
                </div> -->
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="d-flex mt-3">
                    <button type="submit" class="btn btn-primary">Add Beginning Balance</button>
                    <button type="reset" class="btn btn-danger">Clear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>