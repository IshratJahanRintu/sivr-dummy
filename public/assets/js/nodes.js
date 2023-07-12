/**
 *************
 * *********** COMMON VARIABLES **********************
 * ***********
 * */
const menu = document.getElementById("contextMenu");
const nodes = document.querySelectorAll('.node-name');
const files = document.querySelectorAll('.files');
let clickedElement = null;
let sivrPageId = null;
let sivrPage = null;
let pageElements = null;



Array.from(nodes).forEach(function (element) {
    element.addEventListener("contextmenu",
        function (e) {
            clickedElement = element;
            sivrPageId = clickedElement.dataset.sivrpageId;
            sivrPage = findPageById(sivrPageId);
            console.log(sivrPage);
            e.preventDefault();
            menu.style.display = "block";
            menu.style.left = e.pageX;
            menu.style.top = e.pageY;
            menu.style.position = "fixed";

            // Calculate the offset from the viewport's top-left corner
            const offsetX = e.pageX - window.scrollX;
            const offsetY = e.pageY - window.scrollY;

            // Adjust the menu position to align with the cursor
            const menuWidth = menu.offsetWidth;
            const menuHeight = menu.offsetHeight;
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;

            if (offsetX + menuWidth > windowWidth) {
                menu.style.left = (windowWidth - menuWidth) + "px";
            } else {
                menu.style.left = offsetX + "px";
            }

            if (offsetY + menuHeight > windowHeight) {
                menu.style.top = (windowHeight - menuHeight) + "px";
            } else {
                menu.style.top = offsetY + "px";
            }


            for (let i = 0; i < files.length; i++) {
                files[i].addEventListener("click", function () {
                    menu.style.display = "none";
                });
            }


            pageElements = sivrPage.page_elements;
            console.log(pageElements);
            let nodeElementModalTableContent = '';
            pageElements.forEach((pageElement) => {

                nodeElementModalTableContent += `
  <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="element-tab" data-bs-toggle="tab"
                                        data-bs-target="#element-tab-pane-${pageElement.id}" type="button" role="tab"
                                        aria-controls="element-tab-pane-${pageElement.id}" aria-selected="true"><i class="ph-fill ph-stack"></i>
                                    Element Info
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#edit-tab-pane-${pageElement.id}"
                                        type="button" role="tab" aria-controls="edit-tab-pane-${pageElement.id}" aria-selected="true"><i
                                        class="ph-fill ph-pencil-simple-line"></i> Edit
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#upload-tab-pane-${pageElement.id}"
                                        type="button" role="tab" aria-controls="upload-tab-pane-${pageElement.id}" aria-selected="false"><i
                                        class="ph-fill ph-upload"></i> Upload Menu Icon
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="disabled-tab" data-bs-toggle="tab"
                                        data-bs-target="#delete-tab-pane-${pageElement.id}" type="button" role="tab"
                                        aria-controls="delete-tab-pane-${pageElement.id}" aria-selected="false"><i
                                        class="ph-fill ph-trash-simple"></i> Delete
                                </button>
                            </li>
                        </ul>


                        <div class="tab-content" id="nodeTabContent">

                            <div class="tab-pane fade show active" id="element-tab-pane-${pageElement.id}" role="tabpanel"
                                 aria-labelledby="element-tab" tabindex="0">
                                   <div class="table-responsive">
                              <table class="table table-bordered table-striped table-sm border-secondary page-elements">
                    <tbody>
                        <tr>
                            <td>Element Type:</td>
                            <td>${pageElement.type}</td>
                            </tr>
                            <td>Element Order</td>
                            <td>${pageElement.element_order}</td>
                            </tr>
                            <td>Text (EN) :</td>
                            <td>${pageElement.display_name_en}</td>
                            </tr>
                            <td>Text (BN) :</td>
                            <td>${pageElement.display_name_bn}</td>
                            </tr>
                            <td>Text Color :</td>
                            <td>${pageElement.text_color}</td>
                            </tr>
                            <td>Background Color :</td>
                            <td>${pageElement.background_color}</td>
                            </tr>
                            <td>Element Name :</td>
                            <td>${pageElement.name}</td>
                            </tr>
                            <td>Element Value :</td>
                            <td>${pageElement.value}</td>
                            </tr>
                            <td>No Of Rows :</td>
                            <td>${pageElement.rows}</td>
                            </tr>
                            <td>No Of Columns :</td>
                            <td>${pageElement.columns}</td>
                            </tr>
                            <td>Element Visiblity :</td>
                            <td>${(pageElement.is_visible==='Y')?'Visible':'Not Visible'}</td>
                            </tr>
                            <td>Data Provider Funtion :</td>
                            <td>${pageElement.data_provider_function}</td>
                            </tr>



                    </tbody>
                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="edit-tab-pane-${pageElement.id}" role="tabpanel" aria-labelledby="edit-tab"
                                 tabindex="0">EDIT
                            </div>
                            <div class="tab-pane fade" id="upload-tab-pane-${pageElement.id}" role="tabpanel" aria-labelledby="upload-tab"
                                 tabindex="0">Upload
                            </div>
                            <div class="tab-pane fade" id="delete-tab-pane-${pageElement.id}" role="tabpanel" aria-labelledby="delete-tab"
                                 tabindex="0">Edit
                            </div>
                        </div>

        `;
            });
            /**
             *************
             * *********** PAGE ELEMENTS**********************
             * ***********
             * */

                // Node elements variables//
            const nodeElementModal = document.getElementById('node-element-modal');
            nodeElementModal.innerHTML = `  <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">SIVR PAGE ELEMENTS</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body ">
                           <div class="row">
                <div class="col text-end">
                    <div class="add-new-page-element-btn">
                        <a href="" class="btn btn-outline-primary btn-sm fw-bold"><i class="bi bi-plus-lg"></i> Add New Page Element</a>
                    </div>
                </div>
            </div>

                      ${nodeElementModalTableContent}


                    </div>
                </div>
        </div>`;
        });

    document.addEventListener("click", function () {
        menu.style.display = "none";
    });
});
// tree.addEventListener('contextmenu', function (event) {
//
//     event.preventDefault();
//
//     clickedElement = event.target;
//     if (clickedElement.classList.contains('node-name')) {
//         rightClickedNode = clickedElement.parentElement;
//         showFloatingOption(event.clientX, event.clientY);
//     }
// });


/**
 *************
 * *********** ADD FUNCTIONALITIES **********************
 * ***********
 * */

//add variables
const addOption = document.getElementById('add-option');
const parentIdInput = document.getElementById('add-parent-page-id');

//Event listener for add option
addOption.addEventListener('click', function () {

    if (clickedElement != null) {
        parentIdInput.value = sivrPageId;


    }


});
/**
 *************
 * *********** EDIT FUNCTIONALITIES **********************
 * ***********
 * */

//Edit variables///
const editOption = document.getElementById('edit-option');
const editPageForm = document.getElementById('edit-page-form');
const editPageVivrIdInput = document.getElementById('edit_vivr_id');
const editTaskInput = document.getElementById('edit_task');
const editHasPreviousMenuInput = document.getElementById('edit_has_previous_menu');
const editHasMainMenuInput = document.getElementById('edit_has_main_menu');
const editServiceTitleId = document.getElementById('edit_service_title_id');
const editPageHeadingBangla = document.getElementById('edit_page_heading_ban');
const editPageHeadingEnglish = document.getElementById('edit_page_heading_en');
//Event listener for edit option
editOption.addEventListener('click', function () {


    editPageVivrIdInput.value = sivrPage.vivr_id;
    editPageHeadingBangla.value = sivrPage.page_heading_ban;
    editPageHeadingEnglish.value = sivrPage.page_heading_en;
    for (let i = 0; i < editServiceTitleId.options.length; i++) {
        const option = editServiceTitleId.options[i];
        if (option.value === sivrPage.service_title_id) {
            option.selected = true;
            break;
        }
    }

    for (let i = 0; i < editTaskInput.options.length; i++) {
        const option = editTaskInput.options[i];
        if (option.value === sivrPage.task) {
            option.selected = true;
            break;
        }
    }
    for (let i = 0; i < editPageVivrIdInput.options.length; i++) {
        const option = editPageVivrIdInput.options[i];
        if (option.value === sivrPage.vivr_id) {
            option.selected = true;
            break;
        }
    }
    for (let i = 0; i < editHasMainMenuInput.options.length; i++) {
        const option = editHasMainMenuInput.options[i];
        if (option.value === sivrPage.has_main_menu) {
            option.selected = true;
            break;
        }
    }
    for (let i = 0; i < editHasPreviousMenuInput.options.length; i++) {
        const option = editHasPreviousMenuInput.options[i];
        if (option.value === sivrPage.has_previous_menu) {
            option.selected = true;
            break;
        }
    }
    const formAction = editPageForm.getAttribute('action').replace('PAGE', sivrPageId);
    editPageForm.setAttribute('action', formAction);

});

/**
 *************
 * *********** EDIT FUNCTIONALITIES **********************
 * ***********
 * */

/// DELETE  variables////
const deleteTreeMenuItem = document.getElementById('jsDeleteTreeConfirm');
const deleteToast = document.getElementById('delete-toast');
const deletePageForm = document.getElementById('delete-sivrPage-form');
const deleteConfirmButton = document.getElementById('delete-confirm');
const cancelButton = document.getElementById('delete-cancel');
deleteTreeMenuItem.addEventListener('click', () => {
    deleteToast.classList.toggle('d-none');
    const formAction = deletePageForm.getAttribute('action').replace(':sivrpageid', sivrPageId);
    deletePageForm.setAttribute('action', formAction);
});
cancelButton.addEventListener('click', () => {
    deleteToast.classList.toggle('d-none');
});

deleteConfirmButton.addEventListener('click', () => {
    deletePageForm.submit();
});

function findPageById(sivrPageId) {
    console.log(sivrPagesJson);
    return sivrPagesJson.find(sivrPage => sivrPage.id === parseInt(sivrPageId));
}

//
// // ************************Audio file upload script************************//
//
// let audioFiles = [];
// let currentAudioIndex = -1;
//
// function highlightCurrentAudio() {
//     let listItems = document.querySelectorAll('#audioList li');
//     for (let i = 0; i < listItems.length; i++) {
//         listItems[i].classList.remove('highlight');
//     }
//
//     if (currentAudioIndex >= 0 && currentAudioIndex < listItems.length) {
//         listItems[currentAudioIndex].classList.add('highlight');
//     }
// }
//
// function playAudio(index) {
//     currentAudioIndex = index;
//     highlightCurrentAudio();
//
//     if (index >= 0 && index < audioFiles.length) {
//         let file = audioFiles[index];
//         document.getElementById('audioSource').src = file.url;
//         document.getElementById('audioPlayer').load();
//         document.getElementById('audioPlayer').play();
//     }
// }
//
// document.getElementById('audioForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//
//     let fileInput = document.getElementById('audioInput');
//     let fileList = fileInput.files;
//
//     for (let i = 0; i < fileList.length; i++) {
//         let file = fileList[i];
//         let listItem = document.createElement('li');
//         listItem.textContent = file.name;
//         listItem.addEventListener('click', function (index) {
//             return function () {
//                 playAudio(index);
//             };
//         }(audioFiles.length));
//         document.getElementById('audioList').appendChild(listItem);
//
//         let reader = new FileReader();
//         reader.onload = function (e) {
//             audioFiles.push({
//                 name: file.name,
//                 url: e.target.result
//             });
//         };
//         reader.readAsDataURL(file);
//     }
//
//     fileInput.value = '';
// });
//
// document.getElementById('audioPlayer').addEventListener('ended', function () {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// });
//
// document.addEventListener('keydown', function (e) {
//     if (e.key === 'ArrowLeft') {
//         if (currentAudioIndex > 0) {
//             playAudio(currentAudioIndex - 1);
//         }
//     } else if (e.key === 'ArrowRight') {
//         if (currentAudioIndex < audioFiles.length - 1) {
//             playAudio(currentAudioIndex + 1);
//         }
//     }
// });
//
// document.getElementById('audioPlayer').addEventListener('ended', function () {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// });
//
//
// document.getElementById('audioPlayer').addEventListener('play', function () {
//     if (currentAudioIndex >= 0 && currentAudioIndex < audioFiles.length) {
//         highlightCurrentAudio();
//     }
// });
//
// document.getElementById('audioPlayer').addEventListener('ended', function () {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// });
//
// function playNext() {
//     if (currentAudioIndex < audioFiles.length - 1) {
//         playAudio(currentAudioIndex + 1);
//     }
// }
//
// function playPrevious() {
//     if (currentAudioIndex > 0) {
//         playAudio(currentAudioIndex - 1);
//     }
// }
//
// document.getElementById('nextButton').addEventListener('click', playNext);
// document.getElementById('previousButton').addEventListener('click', playPrevious);






