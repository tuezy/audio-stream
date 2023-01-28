<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id-field" />

                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="id-field1" class="form-label">ID</label>
                        <input type="text" id="id-field1" class="form-control" placeholder="ID" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Customer Name</label>
                        <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required />
                        <div class="invalid-feedback">Please enter a customer name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="form-label">Email</label>
                        <input type="email" id="email-field" class="form-control" placeholder="Enter email" required />
                        <div class="invalid-feedback">Please enter an email.</div>
                    </div>

                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Phone</label>
                        <input type="text" id="phone-field" class="form-control" placeholder="Enter phone no." required />
                        <div class="invalid-feedback">Please enter a phone.</div>
                    </div>

                    <div class="mb-3">
                        <label for="date-field" class="form-label">Joining Date</label>
                        <input type="date" id="date-field" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" required placeholder="Select date" />
                        <div class="invalid-feedback">Please select a date.</div>
                    </div>

                    <div>
                        <label for="status-field" class="form-label">Status</label>
                        <select class="form-control" data-choices data-choices-search-false name="status-field" id="status-field"  required>
                            <option value="">Status</option>
                            <option value="Active">Active</option>
                            <option value="Block">Block</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>