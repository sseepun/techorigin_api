<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalTitle" aria-hidden="true">
    <form action="/api/upload-slips" method="POST" id="uploader-form" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalTitle">
                        Import เงินเดือน
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label for="name" class="col-sm-4 col-form-label">
                            ชื่อรายการนำเข้า
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="name" required maxlength="256" />
                        </div>
                    </div>
                    <div id="uploader-zone" class="uploader-zone">
                        <i class="flaticon2-download"></i> 
                        <h3>เลือกไฟล์ .txt</h3>
                        <input type="file" multiple="" accept=".txt" />
                    </div>
                    <div class="scroll-container">
                        <ul class="list-unstyled p-2 d-flex flex-column col" id="uploader-files"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-btn-primary btn-font-sm">
                        บันทึก
                    </button>
                    <button type="button" class="btn custom-btn-secondary" data-dismiss="modal">
                        ยกเลิก
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="/assets/plugins/dm-uploader/dist-build/js/jquery.dm-uploader.min.js"></script>
<script type="text/html" id="uploader-file-template">
    <li class="media">
        <div class="media-body mb-1">
            <p class="mb-2">
                <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
            </p>
            <div class="progress mb-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" 
                aria-valuemax="100"></div>
            </div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>
<script>
    $(function(){ 'use strict';

        var uploadModal = $('#uploadModal'),
            uploadModalForm = uploadModal.find('form#uploader-form'),
            uploaded = false;
        if(uploadModal.length){
            uploadModal.find('#uploader-zone').dmUploader({
                url: '/api/ajax/upload-text-files',
                auto: false,
                queue: true,
                method: 'POST',
                dataType: 'json',
                fieldName: 'txt_file',
                onNewFile: function(id, file){
                    uploaded = true;
                    uploaderMultiAddFile(id, file);
                },
                onBeforeUpload: function(id){
                    uploaderMultiUpdateFileStatus(id, 'uploading', 'Uploading...');
                    uploaderMultiUpdateFileProgress(id, 0, '', true);
                },
                onUploadProgress: function(id, percent){
                    uploaderMultiUpdateFileProgress(id, percent);
                },
                onUploadSuccess: function(id, data){
                    uploaderMultiUpdateFileStatus(id, 'success', 'Upload Complete');
                    uploaderMultiUpdateFileProgress(id, 100, 'success', false);
                    if(data.success){
                        uploadModalForm.append(
                            '<input type="hidden" name="file_names[]" value="'+data.data.file_name+'" />'
                        );
                    }
                },
                onUploadError: function(id, xhr, status, message){
                    uploaderMultiUpdateFileStatus(id, 'danger', message);
                    uploaderMultiUpdateFileProgress(id, 0, 'danger', false);  
                },
                onComplete: function(){
                    setTimeout(function(){
                        uploadModalForm[0].submit();
                    }, 600);
                }
            });
            
            uploadModalForm.on('submit', function(e){
                e.preventDefault();
                if(uploaded){
                    uploadModal.find('#uploader-zone').dmUploader('start');
                    uploadModal.find('#uploader-zone').slideUp(600);
                    uploadModal.find('.modal-footer').slideUp(600);
                    uploadModal.find('button.close').addClass('disabled');
                    uploadModal.find('.scroll-container').addClass('expanded');
                }
            })

            function uploaderMultiAddFile(id, file){
                var template = $('#uploader-file-template').text();
                template = template.replace('%%filename%%', file.name);

                template = $(template);
                template.prop('id', 'uploaderFile' + id);
                template.data('file-id', id);

                $('#uploader-files').find('li.empty').fadeOut();
                $('#uploader-files').prepend(template);
            }
            function uploaderMultiUpdateFileStatus(id, status, message){
                $('#uploaderFile' + id).find('span').html(message).prop('class', 'status text-' + status);
            }
            function uploaderMultiUpdateFileProgress(id, percent, color, active){
                color = (typeof color === 'undefined' ? false : color);
                active = (typeof active === 'undefined' ? true : active);

                var bar = $('#uploaderFile' + id).find('div.progress-bar');

                bar.width(percent + '%').attr('aria-valuenow', percent);
                bar.toggleClass('progress-bar-striped progress-bar-animated', active);

                if(percent===0) bar.html('');
                else bar.html(percent + '%');

                if(color !== false){
                    bar.removeClass('bg-success bg-info bg-warning bg-danger');
                    bar.addClass('bg-' + color);
                }
            }
            function uploaderMultiUpdateFileControl(id, start, cancel, wasError){
                wasError = (typeof wasError === 'undefined' ? false : wasError);

                $('#uploaderFile' + id).find('button.start').prop('disabled', !start);
                $('#uploaderFile' + id).find('button.cancel').prop('disabled', !cancel);

                if(!start && !cancel) $('#uploaderFile' + id).find('.controls').fadeOut();
                else $('#uploaderFile' + id).find('.controls').fadeIn();

                if(wasError) $('#uploaderFile' + id).find('button.start').html('Retry');
            }

        }

    });
</script>
