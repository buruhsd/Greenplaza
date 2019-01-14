<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Place Order</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="submit" class="btn btn-success" value="Pay" id="pay-button">
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=""></script>
<script type="text/javascript">
    // <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
            // Optional
            onSuccess: function(result){
                /* You may add your own js here, this is just example */ 
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // parse to form_data
                var form_data = new FormData();
                for ( var key in result ) {
                    form_data.append(key, result[key]);
                }
                console.log(form_data);
            },
            // Optional
            onPending: function(result){
                console.log(result);
                /* You may add your own js here, this is just example */ 
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // parse to form_data
                var form_data = new FormData();
                for ( var key in result ) {
                    form_data.append(key, result[key]);
                }
                console.log(form_data);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ 
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // parse to form_data
                var form_data = new FormData();
                for ( var key in result ) {
                    form_data.append(key, result[key]);
                }
                console.log(form_data);
            }
        });
    };
</script>
