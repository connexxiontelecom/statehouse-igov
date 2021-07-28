<script>
  $(document).ready(() => {
    Dropzone.autoDiscover = false
    let name = new Date().getTime()
    $('div#myId').dropzone({
      renameFile: file => name + '_' + file.name.replace(/\s/g, ''),
      url: '<?=site_url('upload-mail-attachments')?>',
      method: 'post',
      addRemoveLinks: 'true',
      dictRemoveFile: 'Remove',
      success: (file, response) => {
        $('form').append('<input type="hidden" name="m_attachments[]" value="' + response + '">');
        console.log(response)
      },
      error: (file, response) => console.log(response),
      removedfile: file => {
        file.previewElement.remove()
        $('form').find('input[name="m_attachments[]"][value="' + name + '_' + file.name + '"]').remove()
        let m_name = name + "_" + file.name
        $.ajax({
          url: '<?=site_url('delete-mail-attachments')?>',
          type: 'GET',
          data:  'files='+m_name,
          dataType: 'json',
          success: response => {
            // console.log(response.message);
          },
          cache: false,
          contentType: false,
          processData: false
        });
      }
    })

    $('form#new-incoming-mail-form').submit(function(e) {
      e.preventDefault()
      let refNo = $('#ref-no').val()
      let subject = $('#subject').val()
      let sender = $('#sender').val()
      let dateCorrespondence = $('#date-correspondence').val()
      let dateReceived = $('#date-received').val()
      if (!refNo || !subject || !sender || !dateCorrespondence || !dateReceived) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let formData = new FormData(this)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will register this mail in the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/incoming-mail')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/central-registry')?>')
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
    })
  })

  function fileMail() {
    let refNo = $('#file-ref-no').val()
    if (!refNo) {
      Swal.fire('Invalid Submission!', 'Please enter the file cabinet number', 'error')
    } else {
      let formData = new FormData()
      let mailID = $('#mail-id').val()
      formData.append('m_id', mailID)
      formData.append('m_file_ref_no', refNo)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will file this mail with a new file cabinet number.',
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

  function transferMail() {
    let userID = $('#mh-holder-id').val()
    if (!userID) {
      Swal.fire('Invalid Submission!', 'Please select the new mail recipient', 'error')
    } else {
      let formData = new FormData()
      let mailID = $('#mail-id').val()
      formData.append('m_id', mailID)
      formData.append('mh_holder_id', userID)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will transfer this mail to the new recipient.',
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
</script>