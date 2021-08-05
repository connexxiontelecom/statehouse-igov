<script>
  function transferMail() {
    let userID = $('#mt-to-id').val()
    if (!userID) {
      Swal.fire('Invalid Submission!', 'Please select the new mail recipient', 'error')
    } else {
      let formData = new FormData()
      let mailID = $('#mail-id').val()
      formData.append('mt_mail_id', mailID)
      formData.append('mt_to_id', userID)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit transfer request to the new recipient. The recipient must confirm they have received the physical copy.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/transfer-mail')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.reload())
              } else {
                Swal.fire('Sorry!', response.message, 'error')
              }
            },
            cache: false,
            contentType: false,
            processData: false
          })
        } else {
          location.reload()
        }
      })
    }
  }

  function fileMail() {
    let refNo = $('#file-ref-no').val()
    if (!refNo) {
      Swal.fire('Invalid Submission!', 'Please enter the file cabinet number', 'error')
    } else {
      let formData = new FormData()
      let mailID = $('#mail-id').val()
      formData.append('mf_mail_id', mailID)
      formData.append('mf_file_ref_no', refNo)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will set a new file cabinet number for this mail.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/file-mail')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.reload())
              } else {
                Swal.fire('Sorry!', response.message, 'error')
              }
            },
            cache: false,
            contentType: false,
            processData: false
          })
        }
      })
    }
  }
</script>