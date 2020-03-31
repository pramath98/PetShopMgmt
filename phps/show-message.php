<?php

//session_start();

if(isset($_SESSION['message'])) {

  echo' 
  <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 id="messageTextBox">
          '.$_SESSION['message'].'
          </h3>';
          if(isset($_SESSION['message_desc'])) {
            echo $_SESSION['message_desc'];
          }
  echo' </div>
      </div>
    </div>
  </div>
';

    unset($_SESSION['message']);
    if(isset($_SESSION['message_desc'])) {
      unset($_SESSION['message_desc']);
    }
}

?>