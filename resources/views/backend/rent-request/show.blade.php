<div class="modal fade" id="rentRequestModal" tabindex="-1" aria-labelledby="rentRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rentRequestModalLabel">
                    <i class="fas fa-car text-primary me-2"></i>Rent Request Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="card-title text-muted mb-0">
                                    <i class="fas fa-car-alt me-2"></i>Car Details
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                        <span>Car Name</span>
                                        <strong id="carName">Toyota Camry</strong>
                                    </div>
                                    <div class="list-group-item">
                                        <span>Car Type</span>
                                        <strong id="carType">Sedan</strong>
                                    </div>
                                    <div class="list-group-item">
                                        <span>Car Number</span>
                                        <strong id="carNumber">AB-1234-XY</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <strong id="customerName">John Doe</strong>
                                    </div>
                                    <div class="list-group-item">
                                        <span>Email</span>
                                        <strong id="customerEmail">john.doe@example.com</strong>
                                    </div>
                                    <div class="list-group-item">
                                        <span>Phone</span>
                                        <strong id="customerPhone">+1 (555) 123-4567</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-decline text-white" id="declineButton"><i class="fa fa-ban"></i>
                    Decline</button>
                <button type="button" class="btn btn-approve text-white" id="approveButton"><i class="fa fa-check"></i>
                    Approve</button>
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal"><i
                        class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>
