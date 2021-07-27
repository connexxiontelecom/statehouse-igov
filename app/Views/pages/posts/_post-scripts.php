<script>
	$(document).ready(() => {
    Dropzone.autoDiscover = false
    let name = new Date().getTime()
    $('div#myId').dropzone({
      renameFile: file => name + '_' + file.name.replace(/\s/g, ''),
      url: '<?=site_url('upload-post-attachments')?>',
      method: 'post',
      addRemoveLinks: 'true',
      dictRemoveFile: 'Remove',
      success: (file, response) => {
        $('form').append('<input type="hidden" name="p_attachment[]" value="' + response + '">');
        console.log(response)
      },
      error: (file, response) => console.log(response),
      removedfile: file => {
        file.previewElement.remove()
        $('form').find('input[name="p_attachment[]"][value="' + name + '_' + file.name + '"]').remove()
        let p_name = name + "_" + file.name
        $.ajax({
          url: '<?=site_url('delete-post-attachments')?>',
          type: 'GET',
          data:  'files='+p_name,
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
	})

  function verifyDocumentSigning() {
    let verCode = $('#ver-code').val()
    if (!verCode) {
      Swal.fire('Invalid Submission!', 'Please enter the verification code', 'error')
    } else {
      let formData = new FormData()
      let postID = $('#post-id').val()
      let eSignature = $('#e-signature').val()
      formData.append('p_id', postID)
      formData.append('p_signature', eSignature)
      formData.append('ver_code', verCode)
      $.ajax({
        url: '<?=site_url('/sign-post')?>',
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
  }

  function declineDocument(postID) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'This document will not be published. This action is irreversible.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33"
    }).then(confirm => {
      if (confirm.value) {
        let formData = new FormData()

        formData.append('p_id', postID)
        $.ajax({
          url: '<?=site_url('/decline-post')?>',
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
          processData: false,
        })
      }
    })
  }

  function signDocument(postID) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'This will publish the document with you as the signatory. This action is irreversible.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
    }).then(confirm => {
      if (confirm.value) {
        jQuery.noConflict()
        $('#loading-modal').modal('toggle');
        $.ajax({
          url: '<?=site_url('/check-signature-exists')?>',
          type: 'get',
          success: response => {
            if (response.success) {
              $('#post-id').val(postID)
              $('#e-signature').val(response.message)
              let formData = new FormData()
              formData.append('p_id', postID)
              $.ajax({
                url: '<?=site_url('/send-doc-signing-verification')?>',
                type: 'post',
                data: formData,
                success: response => {
                  if (response.success) {
                    Swal.fire('Confirmed!', response.message, 'success').then(() => {
                      jQuery.noConflict()
                      $('#loading-modal').modal('hide');
                      $('#standard-modal-3').modal('show');
                    })
                  } else {
                    Swal.fire('Sorry!', response.message, 'error').then(() => {
                      jQuery.noConflict()
                      $('#loading-modal').modal('hide');
                    })
                  }
                },
                cache: false,
                contentType: false,
                processData: false
              })
            } else {
              Swal.fire('Sorry!', response.message, 'error').then(() => location.href = '<?=site_url('/my-account')?>')
            }
          },
          cache: false,
          contentType: false,
          processData: false
        })
      }
    })
  }
</script>