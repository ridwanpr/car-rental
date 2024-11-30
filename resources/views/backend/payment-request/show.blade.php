<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">
                    <i class="fas fa-money-bill-wave text-primary me-2"></i>Payment Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="card-title text-muted mb-0">
                                    <i class="fas fa-user me-2"></i>Customer Details
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                        <span>Name</span>
                                        <strong id="customerName"></strong>
                                    </div>
                                    <div class="list-group-item">
                                        <span>Email</span>
                                        <strong id="customerEmail"></strong>
                                    </div>
                                    <div class="list-group-item">
                                        <span>Phone</span>
                                        <strong id="customerPhone"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="card-title text-muted mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Payment Information
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
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
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="card-title text-muted mb-0">
                                    <i class="fas fa-receipt me-2"></i>Payment Proof
                                </h6>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <img id="paymentProof" src="" alt="Payment Proof Image"
                                    class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-decline text-white" id="declineButton">
                    <i class="fa fa-ban"></i> Decline
                </button>
                <button type="button" class="btn btn-approve text-white" id="approveButton">
                    <i class="fa fa-check"></i> Approve
                </button>
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
