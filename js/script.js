

//  document.querySelector(".icon-list").addEventListener('onclick',function(){
//     alert('heelo');
//  });


 var listButton = document.querySelector(".icon-list"); // Get the button element
 var sidebar = document.querySelector('.sidebar'); // Get the sidebar element
 var content = document.querySelector('.main-box'); // Get the main content element

 // Define the media query for large screens
 var mediaQuery = window.matchMedia('(min-width: 692px)');
 var sidebarState = localStorage.getItem('#sidebarState') || 'shown'; // Default to 'shown'
 var a = (sidebarState === 'shown') ? 1 : 2; // Set initial value of 'a' based on sidebar state

 // Function to handle sidebar visibility for large screens
 function toggleSidebar() {
     if (a == 1) {
         sidebar.classList.add('hidden'); // Hide the sidebar
         content.classList.add('full-width'); // Expand content width
         localStorage.setItem('sidebarState', 'hidden'); // Save state
         a = 2;
     } else {
         sidebar.classList.remove('hidden'); // Show the sidebar
         content.classList.remove('full-width'); // Shrink content width
         localStorage.setItem('sidebarState', 'shown'); // Save state
         a = 1;
     }
 }

 // Function to handle sidebar logic only for large screens
 function handleSidebarToggle() {
     if (mediaQuery.matches) {
         // Large screens: Apply sidebar toggle logic
         if (sidebarState === 'hidden') {
             sidebar.classList.add('hidden');
             content.classList.add('full-width');
         } else {
             sidebar.classList.remove('hidden');
             content.classList.remove('full-width');
         }

         // Add click event listener to toggle button (for large screens only)
         listButton.removeEventListener('click', toggleSidebar); // Remove existing listener to avoid duplicates
         listButton.addEventListener('click', toggleSidebar); // Attach fresh listener
     } else {
         // Small screens: Ensure sidebar is always visible (reset styles)
         sidebar.classList.remove('hidden');
         content.classList.remove('full-width');
     }
 }

 // Initial call to set up the sidebar based on screen size
 handleSidebarToggle();

 // Add a listener for window resize to re-check the media query
 window.addEventListener('resize', handleSidebarToggle);
