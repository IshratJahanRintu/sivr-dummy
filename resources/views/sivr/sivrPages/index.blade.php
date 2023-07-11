@extends('layout.app')
@section('content')
    <script>
        let sivrPagesJson = {!!   $sivrPagesJson !!};
    </script>
    <div class="g-page-content-area">

        <div class="g-page-content-main">


            <!--**********************************
                          SIVR TREE MENU
             ***********************************-->
            <div class="container-fluid mb-3">
                <div class="g-sivr-tree-area">
                    <div class="g-sivr-tree-main">
                        <div class="card">
                            <div class="card-body">
                                <div class="g-tree-view-area">
                                    <h3 class="heading">SIVR Tree Menu</h3>
                                    <div class="file-browser">


                                        <ul>
                                            @if(($sivrPages->count() == 0))
                                                <button id="add-child-button">Add Child</button>
                                            @else
                                                @foreach ($sivrPages as $sivrPage)
                                                    <li class="{{$sivrPage->hasChildren()?'folder':'file'}} "><span
                                                            data-sivrpage-id={{$sivrPage->id}} class="node-name">{{$sivrPage->page_heading_en}}</span>

                                                        @include('sivr.sivrPages.children', ['children' => $sivrPage->children])
                                                    </li>
                                                @endforeach

                                        </ul>
                                        @endif

                                    </div>
                                </div>
                            </div>


                        </div>


                        <!--**********************************
                                    Right Context Menu
                         ***********************************-->
                        <div id="contextMenu" class="context-menu">
                            <ul class="list-group">
                                <li id="edit-option" class="" data-bs-toggle="modal"
                                    data-bs-target="#g-sivr-edit-modal"><i class="ph-fill ph-pencil-simple"></i>
                                    Edit
                                </li>
                                <li id="add-option" class="" data-bs-target="#g-sivr-add-modal" data-bs-toggle="modal">
                                    <i class="ph-fill ph-plus"></i> Add Branch
                                </li>
                                <li class="" data-bs-target="#g-sivr-audio-upload-modal" data-bs-toggle="modal"><i
                                        class="ph-fill ph-upload"></i> Upload
                                    File
                                </li>
                                <li class="" data-bs-toggle="modal" id="node-element-option"
                                    data-bs-target="#node-element-modal"><i class="ph-fill ph-circles-three-plus"></i>
                                    Node Element
                                </li>
                                <li class="" id="jsDeleteTreeConfirm"><i class="ph-fill ph-trash-simple"></i>
                                    Delete Tree
                                </li>
                            </ul>
                        </div>
                        <!--End Right Context Menu-->

                    </div>


                </div>
            </div>
        </div>


        <!--**********************************
          Modal For Page Edit
 ***********************************-->
        <div class="modal fade" tabindex="-1" id="g-sivr-edit-modal" aria-lebeledby="editfile">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SIVR Page Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="edit-page-form" method="POST"
                          action="{{ route('sivr-pages.update', ['sivr_page' => 'PAGE']) }}">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="edit_service_title_id">Service Title ID</label>
                                <select class="form-control" name="service_title_id" id="edit_service_title_id">
                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_vivr_id">VIVR ID</label>
                                <select class="form-control" name="vivr_id" id="edit_vivr_id">
                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>
                                    <option value="12212">12212</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_task">Task</label>
                                <select class="form-control" name="task" id="edit_task">
                                    <option value="navigation">Navigation</option>
                                    <option value="compare">Compare</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_page_heading_en">Page Heading (EN)</label>
                                <input type="text" class="form-control" name="page_heading_en" id="edit_page_heading_en"
                                       placeholder="Page Heading (EN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_page_heading_ban">Page Heading (BN)</label>
                                <input type="text" class="form-control" name="page_heading_ban"
                                       id="edit_page_heading_ban"
                                       placeholder="Page Heading (BN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_has_main_menu">Navigate To Main Page</label>
                                <select class="form-control" name="has_main_menu" id="edit_has_main_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_has_previous_menu">Navigate To Previous Page</label>
                                <select class="form-control" name="has_previous_menu" id="edit_has_previous_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary text-white">Save Changes</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--End Modal For Page Edit-->


        <!--**********************************
                  Modal For Page Add
         ***********************************-->
        <div class="modal fade" tabindex="-1" id="g-sivr-add-modal" aria-lebeledby="editfile">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SIVR Page ADD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="add-page-form" method="POST" action="{{route("sivr-pages.store")}}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" id="add-parent-page-id" name="parent_page_id" value="">
                            <div class="form-group mb-3">
                                <label for="service_title_id">Service Title ID</label>
                                <select class="form-control" name="service_title_id" id="service_title_id">

                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>
                                    <option value="12212">12212</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="vivr_id">VIVR ID</label>
                                <select class="form-control" name="vivr_id" id="vivr_id">
                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="task">Task</label>
                                <select class="form-control" name="task" id="task">
                                    <option value="navigation">Navigation</option>
                                    <option value="compare">Compare</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="page_heading_en">Page Heading (EN)</label>
                                <input type="text" class="form-control" name="page_heading_en" id="page_heading_en"
                                       placeholder="Page Heading (EN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="page_heading_ban">Page Heading (BN)</label>
                                <input type="text" class="form-control" name="page_heading_ban" id="page_heading_ban"
                                       placeholder="Page Heading (BN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="has_main_menu">Navigate To Main Page</label>
                                <select class="form-control" name="has_main_menu" id="has_main_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="has_previous_menu">Navigate To Previous Page</label>
                                <select class="form-control" name="has_previous_menu" id="has_previous_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary text-white">Add Page</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--**********************************
                Delete Node Element Alert
         ***********************************-->
        <div id="delete-toast"
             class="toast bg-white d-flex align-items-center justify-content-center position-fixed d-none"
             aria-live="assertive" aria-atomic="true" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">

            <div class="toast-body">
                <h6>Are you sure you want to delete the node?</h6>
                <div class="pt-2 border-top">
                    <form id="delete-sivrPage-form"
                          action="{{ route('sivr-pages.destroy', ['sivr_page' => ':sivrpageid']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="delete-confirm" type="submit" class="btn btn-primary btn-sm text-white">Confirm
                        </button>
                        <button id="delete-cancel" type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="toast">Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!--**********************************
      Modal For Audio File Upload
         ***********************************-->
        <div class="modal fade" tabindex="-1" id="g-sivr-audio-upload-modal" aria-lebeledby="audiofileupload">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Audio <i class="ph-fill ph-music-note"></i> File Upload</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6> Audio Upload Here</h6>

                        <form class="d-inline-flex gap-2 mb-3 w-100" id="audioForm" enctype="multipart/form-data"
                              multiple>

                            <input class="form-control" type="file" accept="audio/*" id="audioInput"/>

                            <button class="btn btn-success btn-sm" type="submit">Upload</button>
                        </form>

                        <h6>Uploaded Audio List</h6>
                        <ul id="audioList"></ul>

                        <hr/>
                        <div class="g-player">
                            <audio class="w-100" id="audioPlayer" controls>
                                <source id="audioSource" src="" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="g-player-controls">
                                <button class="btn btn-sm btn-secondary" id="previousButton"><i
                                        class="ph-fill ph-skip-back"></i></button>
                                <button class="btn btn-sm btn-secondary" id="nextButton"><i
                                        class="ph-fill ph-skip-forward"></i>
                                </button>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary text-white">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!--**********************************
                 Modal For Node Element
         ***********************************-->
        <div id="node-element-modal" class="modal fade" tabindex="-1" aria-lebeledby="node-element">

        </div>
    </div>

@endsection

