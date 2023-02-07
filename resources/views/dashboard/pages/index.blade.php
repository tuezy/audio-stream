@extends("dashboard.main")
@section("content")
<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column justify-content-end">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Good Morning, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h4>
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form action="" method="GET">
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <input type="text" name="start_date"
                                                   class="form-control border-0 dash-filter-picker shadow"
                                                   data-provider="flatpickr"
                                                   data-date-format="d-m-Y"
                                                   data-deafult-date="{{ $startDate }}">
                                            <div
                                                    class="input-group-text bg-primary border-primary text-white">
                                                From
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <input type="text" name="end_date"
                                                   class="form-control border-0 dash-filter-picker shadow"
                                                   data-provider="flatpickr"
                                                   data-date-format="d-m-Y"
                                                   data-deafult-date="{{ $endDate }}">
                                            <div
                                                    class="input-group-text bg-primary border-primary text-white">
                                                To
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-soft-success"><i
                                                    class="ri-add-circle-line align-middle me-1"></i>
                                            Refresh</button>
                                    </div>

                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>
@endsection