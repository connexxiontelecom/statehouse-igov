<?=view('pages/posts/_post-scripts.php')?>
<script>
  function createNotice() {
	  let noticeForm = $('form#new-notice-form')[0]
    let refNo = $('#ref-no').val()
    let subject = $('#subject').val()
    let signedBy = $('#signed-by').val()
    if (!refNo || !subject || !signedBy || quillEditor.root.innerText.length < 2) {
      Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
    } else {
      let formData = new FormData(noticeForm)
      formData.append('p_body', quillEditor.root.innerHTML)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit your notice to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/new-notice')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-notices')?>')
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

  function editNotice() {
    let noticeForm = $('form#edit-notice-form')[0]
    let refNo = $('#ref-no').val()
    let subject = $('#subject').val()
    let signedBy = $('#signed-by').val()
    if (!refNo || !subject || !signedBy || quillEditor.root.innerText.length < 2) {
      Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
    } else {
      let formData = new FormData(noticeForm)
      formData.append('p_body', quillEditor.root.innerHTML)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit new changes to your Notice to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/edit-notice')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-notices')?>')
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