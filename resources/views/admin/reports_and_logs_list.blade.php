@include('admin.includes.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                   <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mt-2"><i class="fas fa-chart-line text-primary mr-2"></i> Reports and Logs</h4>
                        </div>
                        <hr class="mt-0 mb-0">
                        <div class="card-body">
                            <div class="row">

                                <!-- User Reports -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card report-card text-center shadow border-0 h-100">
                                        <div class="card-body">
                                            <i class="fas fa-user text-primary fa-3x mb-3"></i>
                                            <h5 class="card-title">User Reports</h5>
                                            <p class="text-muted small">Track user registrations, activity, and family details.</p>
                                            <a href="{{ url('reports/users') }}" class="btn btn-sm btn-outline-primary">View Report</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Family Reports -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card report-card text-center shadow border-0 h-100">
                                        <div class="card-body">
                                            <i class="fas fa-users text-success fa-3x mb-3"></i>
                                            <h5 class="card-title">Family Reports</h5>
                                            <p class="text-muted small">View details of registered family members linked to users.</p>
                                            <a href="{{ url('reports/families') }}" class="btn btn-sm btn-outline-success">View Report</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Emergency Alerts Report -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card report-card text-center border-0 h-100">
                                        <div class="card-body">
                                            <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                                            <h5 class="card-title">Emergency Alerts</h5>
                                            <p class="text-muted small">View and analyze instant emergency alerts raised by users.</p>
                                            <a href="{{ url('reports/emergency-alerts') }}" class="btn btn-sm btn-outline-danger">View Report</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Emergency Responses Report -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card report-card text-center border-0 h-100">
                                        <div class="card-body">
                                            <i class="fas fa-hands-helping text-warning fa-3x mb-3"></i>
                                            <h5 class="card-title">Emergency Responses</h5>
                                            <p class="text-muted small">Check how helpers and police responded to emergencies.</p>
                                            <a href="{{ url('reports/emergency-responses') }}" class="btn btn-sm btn-outline-warning">View Report</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Instant Emergency Groups Report -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card report-card text-center border-0 h-100">
                                        <div class="card-body">
                                            <i class="fas fa-layer-group text-info fa-3x mb-3"></i>
                                            <h5 class="card-title">Instant Emergency Groups</h5>
                                            <p class="text-muted small">List groups created during emergencies with member details.</p>
                                            <a href="{{ url('reports/emergency-groups') }}" class="btn btn-sm btn-outline-info">View Report</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- System Logs -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card report-card text-center border-0 h-100">
                                        <div class="card-body">
                                            <i class="fas fa-database text-secondary fa-3x mb-3"></i>
                                            <h5 class="card-title">System Logs</h5>
                                            <p class="text-muted small">Monitor login attempts, errors, and admin actions.</p>
                                            <a href="{{ url('reports/system-logs') }}" class="btn btn-sm btn-outline-secondary">View Report</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
                <div class="setting-panel-header">Setting Panel
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Select Layout</h6>
                    <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout"
                                checked>
                            <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                            <span class="selectgroup-button">Dark</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar"
                                checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Color Theme</h6>
                    <div class="theme-setting-options">
                        <ul class="choose-theme list-unstyled mb-0">
                            <li title="white" class="active">
                                <div class="white"></div>
                            </li>
                            <li title="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li title="black">
                                <div class="black"></div>
                            </li>
                            <li title="purple">
                                <div class="purple"></div>
                            </li>
                            <li title="orange">
                                <div class="orange"></div>
                            </li>
                            <li title="green">
                                <div class="green"></div>
                            </li>
                            <li title="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.footer')