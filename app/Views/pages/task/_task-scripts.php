<script>
  $(document).ready(() => {
    $('form#new-task-form').submit(function (e) {
      e.preventDefault()
      let subject = $('#subject').val()
      let executor = $('#executor').val()
      let dueDate = $('#due-date').val()
      if (!subject || !executor || !dueDate) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let formData = new FormData(this)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will create a new task in the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('new-task')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('tasks')?>')
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

    $('form#task-attachment-form').submit(function (e) {
      e.preventDefault()
      let files = $('#file')[0].files
      let taskID = $('#task-id').val()
      if (!files[0]) {
        Swal.fire('Invalid Submission!', 'Please upload a file before submitting', 'error')
      } else {
        $('#save-btn').attr('hidden', true)
        $('#save-btn-loading').attr('hidden', false)
        let formData = new FormData()
        formData.append('file', files[0])
        formData.append('task_id', taskID)
        $.ajax({
          url: '<?=site_url('/upload-task-attachment')?>',
          type: 'post',
          data: formData,
          success: response => {
            $('#save-btn').attr('hidden', false)
            $('#save-btn-loading').attr('hidden', true)
            if (response.success) {
              Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/task-details/')?>'+taskID)
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

  function startTask(taskID) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'This will start the task on the iGov system',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33"
    }).then(confirm => {
      if (confirm.value) {
        $.ajax({
          url: '<?=site_url('start-task/')?>' + taskID,
          type: 'get',
          success: response => {
            if (response.success) {
              Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/task-details/')?>' + taskID)
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
</script>