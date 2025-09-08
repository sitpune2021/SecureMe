@include('admin.includes.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mt-2"><i class="fas fa-chart-line text-primary mr-2"></i>⚙️ Settings</h4>
                            <!-- <span class="badge badge-info">Overview</span> -->
                        </div>
                        <hr class="mt-0 mb-0">
                        <div class="card-body">
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab">Security</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="preferences-tab" data-toggle="tab" href="#preferences" role="tab">Preferences</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="settingsTabsContent">
        <!-- Profile Tab -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel">
            <form>
                <div class="form-group">
                    <label>Admin Name</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ session('admin_email') }}" readonly>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Profile Photo</label>
                    <input type="file" class="form-control-file">
                </div>
                <button class="btn btn-primary">Update Profile</button>
            </form>
        </div>

        <!-- Security Tab -->
        <div class="tab-pane fade" id="security" role="tabpanel">
            <form>
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control">
                </div>
                <button class="btn btn-warning">Reset Password</button>
            </form>
        </div>

        <!-- Preferences Tab -->
        <div class="tab-pane fade" id="preferences" role="tabpanel">
            <form>
                <div class="form-group">
                    <label>Theme</label>
                    <select class="form-control">
                        <option>Light</option>
                        <option>Dark</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Language</label>
                    <select class="form-control">
                        <option>English</option>
                        <option>Hindi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Time Zone</label>
                    <input type="text" class="form-control" value="Asia/Kolkata">
                </div>
                <button class="btn btn-success">Save Preferences</button>
            </form>
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