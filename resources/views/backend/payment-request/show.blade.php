<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Payment Information</h6>
                        <div class="list-group">
                            <div class="list-group-item">
                                <span>Payment Code</span>
                                <strong id="paymentCode"></strong>
                            </div>
                            <div class="list-group-item">
                                <span>Total Amount</span>
                                <strong class="text-success" id="totalAmount"></strong>
                            </div>
                            <div class="list-group-item">
                                <span>Payment Method</span>
                                <strong id="paymentMethod"></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Bank Details</h6>
                        <div class="list-group">
                            <div class="list-group-item">
                                <span>Account Name</span>
                                <strong id="accountName"></strong>
                            </div>
                            <div class="list-group-item">
                                <span>Account Number</span>
                                <strong id="accountNumber"></strong>
                            </div>
                            <div class="list-group-item">
                                <span>Bank Name</span>
                                <strong id="bankName"></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6 class="text-muted">Payment Proof</h6>
                        <img id="paymentProof" src="" alt="Payment Proof Image"
                            class="img-fluid rounded mx-auto d-block" style="max-height: 400px; object-fit: contain;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-decline text-white" id="declineButton">Decline</button>
                <button type="button" class="btn btn-approve text-white" id="approveButton">Approve</button>
            </div>
        </div>
    </div>
</div>
