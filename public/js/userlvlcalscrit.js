
document.addEventListener('DOMContentLoaded', function() {
    const pointingDialog = document.querySelector(".pointing-dialog");
    const card = document.querySelector(".fixed-size");

    // Function to adjust the height
    function adjustDialogHeight() {
        const cardHeight = card.offsetHeight; // Get the card's height
        const dialogHeight = pointingDialog.offsetHeight; // Get the dialog's height

        console.log(`Card Height: ${cardHeight}, Dialog Height: ${dialogHeight}`); // Debugging

        // Compare and adjust height if necessary
        if (cardHeight > dialogHeight) {
            pointingDialog.style.height = `${cardHeight}px`; // Increase dialog height to match the card
            console.log(`Adjusted Dialog Height: ${pointingDialog.style.height}`); // Debugging
        }
    }

    // Call the function to adjust the height
    adjustDialogHeight();
});

document.addEventListener("DOMContentLoaded", function () {
    var titleElement = document.getElementById("eventTitle");
    var initialFontSize = parseInt(
        window.getComputedStyle(titleElement).fontSize
    );
    var lineHeight = parseInt(window.getComputedStyle(titleElement).lineHeight);
    var maxHeight = lineHeight * 3; // Maximum height for 3 lines

    // Temporarily change content to get single line height
    var originalText = titleElement.innerHTML;
    titleElement.innerHTML = "A"; // Single character
    var singleLineHeight = titleElement.clientHeight;
    titleElement.innerHTML = originalText; // Restore original text

    if (titleElement.clientHeight > maxHeight) {
        // If the title exceeds three lines, adjust the font size
        var reductionFactor = 1.6; // Decrease the font size by an additional 10%
        var newFontSize =
            initialFontSize *
            (maxHeight / titleElement.clientHeight) *
            reductionFactor;
        titleElement.style.fontSize = `${newFontSize}px`;

        // Select all .pointing-dialog elements and increase their height by 30%
        document
            .querySelectorAll(".pointing-dialog")
            .forEach(function (dialog) {
                var currentHeight = dialog.offsetHeight; // Get current height in pixels
                var newHeight = currentHeight * 1.3; // Increase by 30%
                dialog.style.height = `${newHeight}px`; // Set new height
            });
    }
});


// ================================

           $(document).ready(function () {
               // Your existing code...

               $(document).on(
                   "mouseenter",
                   "#calendar .fc-content",
                   function () {
                       var $dialog = $("#pointingDialog");
                       var $content = $("#dialogContent");
                       var eventId = $(this).closest(".fc-event").data("id");
                       var eventTitle = $(this)
                           .closest(".fc-event")
                           .data("title");
                       var eventStart = $(this)
                           .closest(".fc-event")
                           .data("start");
                       var eventEnd = $(this).closest(".fc-event").data("end");
                       var eventstarttime = $(this)
                           .closest(".fc-event")
                           .data("event_start_time");
                       var eventendtime = $(this)
                           .closest(".fc-event")
                           .data("event_end_time");

                       // Example content - replace with dynamic content if needed
                       $content.html(`
            <div class="container-fluid p-0" style="background-color: #f8f9fa;">
                <div class="card border-0">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                        <div class="text-center">
                            <i class="bi bi-calendar3 text-primary" style="font-size: 44px;"></i>
                            <hr class="my-1">
                            <h5 id="eventTitle" class="card-title mt-2 text-dark text-center w-100" style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 16px; word-wrap: break-word;">${eventTitle}</h5>
                        </div>
                        <div class="event-details text-center">
                            <p class="card-text mb-1 text-muted" style="font-family: 'Arial', sans-serif;">
                                <i class="bi bi-calendar3"></i> ${eventStart}
                            </p>
                            <p class="card-text mb-0 text-muted" style="font-family: 'Arial', sans-serif;">
                                <i class="bi bi-calendar-x"></i> ${eventEnd}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-left d-flex align-items-center" style="font-family: 'Arial', sans-serif; background-color: #f8f9fa;">
                        <i class="bi bi-clock text-primary" style="margin-right: 10px;"></i>
                        <p class="card-text mb-2 text-dark" style="margin: 5px;">
                            ${eventstarttime} - ${eventendtime}
                        </p>
                    </div>
                </div>
            </div>
        `);

                       // Position the dialog above the fc-content element
                       var offset = $(this).offset();
                       $dialog.css({
                           top: offset.top - $dialog.outerHeight() - 10, // Adjust as needed
                           left:
                               offset.left +
                               $(this).outerWidth() / 2 -
                               $dialog.outerWidth() / 2,
                           display: "block",
                           opacity: 1, // Ensure opacity is set to 1 on hover
                           transform: "translateY(0)", // Ensure dialog is fully visible on hover
                       });

                       // Use jQuery fadeIn for animation
                       $dialog.stop(true, true).fadeIn(300); // Adjust duration as needed

                       // Mouseleave handler for .fc-content
                       var isMouseInContentOrDialog = false;

                       $(".fc-content").on("mouseenter", function () {
                           isMouseInContentOrDialog = true;
                           $("#pointingDialog").stop(true, true).fadeIn(300); // Ensure dialog remains visible on content hover
                       });

                       $(".fc-content, #pointingDialog").on(
                           "mouseleave",
                           function () {
                               isMouseInContentOrDialog = false;

                               setTimeout(function () {
                                   if (!isMouseInContentOrDialog) {
                                       // Only hide if mouse is not in content or dialog
                                       $dialog.stop(true, true).fadeOut(300); // Adjust duration as needed
                                   }
                               }, 4000); // Adjust the timeout as needed
                           }
                       );

                       $("#pointingDialog").on("mouseenter", function () {
                           isMouseInContentOrDialog = true;
                       });
                   }
               );

               // Your existing click and other event handlers...
           });
// ---------------------------------------
