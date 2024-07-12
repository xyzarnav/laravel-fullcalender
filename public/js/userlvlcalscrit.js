
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

