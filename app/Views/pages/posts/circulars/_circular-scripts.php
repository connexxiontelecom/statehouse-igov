<?=view('pages/posts/_post-scripts.php')?>
<script>
	$(document).ready(function () {
		$('form#new-internal-circular-form').submit(function (e) {
		  e.preventDefault()
      let refNo = $('#ref-no').val()
      let subject = $('#subject').val()
      let signedBy = $('#signed-by').val()
      if (!refNo || !subject || !signedBy || quillEditor.root.innerText.length < 2) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let formData = new FormData(this)
        formData.append('p_body', quillEditor.root.innerHTML)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will submit your circular to the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/internal-circular')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-circulars')?>')
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

    $('form#new-external-circular-form').submit(function (e) {
      e.preventDefault()
      let refNo = $('#ref-no').val()
      let subject = $('#subject').val()
      let signedBy = $('#signed-by').val()
      let recipients = $('#p-recipients').val()
      if (!refNo || !subject || !signedBy || !recipients || quillEditor.root.innerText.length < 2) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let formData = new FormData(this)
        formData.append('p_body', quillEditor.root.innerHTML)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will submit your circular to the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/external-circular')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-circulars')?>')
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

    $('form#edit-circular-form').submit(function (e) {
      e.preventDefault()
      let body = quillEditor.root.innerHTML
      let formData = new FormData(this)
      formData.set('p_body', body)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit new changes to your circular to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/edit-circular')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-circulars')?>')
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
    })
  })


  
</script>

