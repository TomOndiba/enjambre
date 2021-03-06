<script>
    /*
     Copyright 2013 Google Inc. All Rights Reserved.
     
     Licensed under the Apache License, Version 2.0 (the "License");
     you may not use this file except in compliance with the License.
     You may obtain a copy of the License at
     
     http://www.apache.org/licenses/LICENSE-2.0
     
     Unless required by applicable law or agreed to in writing, software
     distributed under the License is distributed on an "AS IS" BASIS,
     WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
     See the License for the specific language governing permissions and
     limitations under the License.
     */
      var config = {
            'client_id': '418571461190-rggdtgbp3qm6kd66ihk0lp4uimtve799.apps.googleusercontent.com',
            'scope': 'https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/youtube.upload'
        };

    function handleClientLoad() {
        // Step 2: Reference the API key
        gapi.client.setApiKey('AIzaSyBiNomg-jjAgGIMuQtYRAHjiVL-_DaShNg');
        window.setTimeout(checkAuth, 1);

    }

    function checkAuth() {
        gapi.auth.authorize(config, function() {
            alert('login complete');
           var accessToken=gapi.auth.getToken();
        });
    }
    (function() {
        var GOOGLE_PLUS_SCRIPT_URL = 'https://apis.google.com/js/client:plusone.js';
        var CHANNELS_SERVICE_URL = 'https://www.googleapis.com/youtube/v3/channels';
        var VIDEOS_UPLOAD_SERVICE_URL = 'https://www.googleapis.com/upload/youtube/v3/videos?uploadType=resumable&part=snippet';
        var VIDEOS_SERVICE_URL = 'https://www.googleapis.com/youtube/v3/videos';
        var INITIAL_STATUS_POLLING_INTERVAL_MS = 15 * 1000;
        
      

        function initiateUpload(e) {
            e.preventDefault();

            var file = $('#file').get(0).files[0];
            if (file) {
                $('#submit').attr('disabled', true);

                var metadata = {
                    snippet: {
                        title: $('#title').val(),
                        description: $('#description').val(),
                        categoryId: 22
                    }
                };

                $.ajax({
                    url: VIDEOS_UPLOAD_SERVICE_URL,
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        Authorization: 'Bearer ' + accessToken,
                        'x-upload-content-length': file.size,
                        'x-upload-content-type': file.type
                    },
                    data: JSON.stringify(metadata)
                }).done(function(data, textStatus, jqXHR) {
                    resumableUpload({
                        url: jqXHR.getResponseHeader('Location'),
                        file: file,
                        start: 0
                    });
                });
            }
        }

        function resumableUpload(options) {
            var ajax = $.ajax({
                url: options.url,
                method: 'PUT',
                contentType: options.file.type,
                headers: {
                    'Content-Range': 'bytes ' + options.start + '-' + (options.file.size - 1) + '/' + options.file.size
                },
                xhr: function() {
                    // Thanks to http://stackoverflow.com/a/8758614/385997
                    var xhr = $.ajaxSettings.xhr();

                    if (xhr.upload) {
                        xhr.upload.addEventListener(
                                'progress',
                                function(e) {
                                    if (e.lengthComputable) {
                                        var bytesTransferred = e.loaded;
                                        var totalBytes = e.total;
                                        var percentage = Math.round(100 * bytesTransferred / totalBytes);

                                        $('#upload-progress').attr({
                                            value: bytesTransferred,
                                            max: totalBytes
                                        });

                                        $('#percent-transferred').text(percentage);
                                        $('#bytes-transferred').text(bytesTransferred);
                                        $('#total-bytes').text(totalBytes);

                                        $('.during-upload').show();
                                    }
                                },
                                false
                                );
                    }

                    return xhr;
                },
                processData: false,
                data: options.file
            });

            ajax.done(function(response) {
                var videoId = response.id;
                $('#video-id').text(videoId);
                $('.post-upload').show();
                checkVideoStatus(videoId, INITIAL_STATUS_POLLING_INTERVAL_MS);
            });

            ajax.fail(function() {
                $('#submit').click(function() {
                    alert('Not yet implemented!');
                });
                $('#submit').val('Resume Upload');
                $('#submit').attr('disabled', false);
            });
        }

        function checkVideoStatus(videoId, waitForNextPoll) {
            $.ajax({
                url: VIDEOS_SERVICE_URL,
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + accessToken
                },
                data: {
                    part: 'status,processingDetails,player',
                    id: videoId
                }
            }).done(function(response) {
                var processingStatus = response.items[0].processingDetails.processingStatus;
                var uploadStatus = response.items[0].status.uploadStatus;

                $('#post-upload-status').append('<li>Processing status: ' + processingStatus + ', upload status: ' + uploadStatus + '</li>');

                if (processingStatus == 'processing') {
                    setTimeout(function() {
                        checkVideoStatus(videoId, waitForNextPoll * 2);
                    }, waitForNextPoll);
                } else {
                    if (uploadStatus == 'processed') {
                        $('#player').append(response.items[0].player.embedHtml);
                    }

                    $('#post-upload-status').append('<li>Final status.</li>');
                }
            });
        }

        $(function() {
            $.getScript(GOOGLE_PLUS_SCRIPT_URL);

            $('#upload-form').submit(initiateUpload);
        });
    })();
</script>
<script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
<div class="post-sign-in">
    <div>
        <img id="channel-thumbnail">
        <span id="channel-name"></span>
    </div>

    <form id="upload-form">
        <div>
            <label for="title">Title:</label>
            <input id="title" type="text" value="Default Title">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description">Default description.</textarea>
        </div>
        <div>
            <input id="file" type="file">
        </div>
        <input id="submit" type="submit" value="Upload">
    </form>

    <div class="during-upload">
        <p><span id="percent-transferred"></span>% done (<span id="bytes-transferred"></span>/<span id="total-bytes"></span> bytes)</p>
        <progress id="upload-progress" max="1" value="0"></progress>
    </div>

    <div class="post-upload">
        <p>Uploaded video with id <span id="video-id"></span>. Polling for status...</p>
        <ul id="post-upload-status"></ul>
        <div id="player"></div>
    </div>
</div>