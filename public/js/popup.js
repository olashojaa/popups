document.addEventListener("DOMContentLoaded", function () {
    // Make an AJAX request to check if the popup should be displayed

    fetch('/check-popup') 
        .then(response => response.json())
        .then(data => {
            // Access the data from the server
            const popupData = data.popupData;
console.log(popupData)
            if (popupData!=null) {
             console.log('klmlk')
                // // Update the content in the popup
                document.querySelector('.popup-content p').innerHTML = JSON.parse(popupData.content);

                //update class
                var popupContent = document.getElementById('popup-content');
                const popup = document.getElementById("popup");
                
                // // Display the popup
                popup.style.display = "block";
            }
        })
        .catch(error => console.error('Error fetching popup data:', error));

      
});
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}