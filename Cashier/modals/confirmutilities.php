
     <!-- Success Modal -->
     <div class="modal fade" id="success1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header custom-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./../assets/svg/check-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Success!</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>Account Title Sucessfully added</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

    <!-- Modal: General Error -->
    <div class="modal fade" id="failed1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./../assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3 id="error1"></h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>


    <!-- Modal for Confirmation (Add) -->
    <div class="modal fade" id="confirmUtil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <span class="d-flex justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
              </svg>
          </span>
          <p class="h3 text-center">Do you want to add this fiscal year</p>
          <p class="text-center">You wont be able to revert this</p>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" id="proceedAdd">Yes</button>
            <button type="button" class="btn btn-secondary mx-2 " data-bs-dismiss="modal" id="backAdd">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Confirmation (Arcive) -->
  <div class="modal fade" id="confirmUtil2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <span class="d-flex justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
              </svg>
          </span>
          <p class="h3 text-center">Do you want to update this fiscal year status</p>
          <p class="text-center">You wont be able to revert this</p>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" id="proceedUpd">Yes</button>
            <button type="button" class="btn btn-secondary mx-2 " data-bs-dismiss="modal" id="backUpd">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>