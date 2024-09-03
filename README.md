# testwordpress
PARTNER IN PUBLISHING TEST


SECTION 1:

1.1 Explain the role of hooks (actions and filters) in extending WooCommerce functionality.

r// Hooks in Woocomerce are really powerfull to extend woocomerce functionallity in this aspects.
You can add additional information towards its segments as everything is split into positions as numbers 3 10 15 20, etc, and it has it's own position in its configuration this helps to avoid touching its core files. for example you can add an action to add something below the title.
add_action('woocommerce_single_product_summary', 'custom_function_below_title', 6);
function custom_function_below_title() {
    echo '<p>Your custom HTML below the title.</p>';
}

And a bunch more exist, you can add you own code with PHP and extend this information towards filters with its taxonomies. so you can call any other information from woocomerce regarding another product to make a comparation. gladly woo has its own variable settings that we can use to extract information.
Fowards this website for additional variable information: https://www.businessbloomer.com/woocommerce-easily-get-product-info-title-sku-desc-product-object/

Aditional when we have meta fields added to the product backend with ACF JetEngine or other plugin, we can call that information just by passing the ID of it into its variable. you can echo it.

1.2 Describe the potential performance implications of excessive custom fields on product pages in a large e-commerce site.

It matters if you going to load a ton of images in additional gallerys or files. As text fields, its only text doesn't affect the loading times as much. But the more information is loading to the DOM those milisenconds starts counting so its better not to add too much fields unless is neccesary. but in general terms its doesnt affects that much if its only informative.
If you loading images the best work arround its lazy them.

SECTION 2.

What could I accomplish
1. Show the JSON data on the backend
2. did a little fix on the information that was brought from the json
3. Couldn't implement a sorting button function for the grid
4. theres a big red button that say open, that opens a popup made with pure css and added a simple jquery toggle for the function. and it says all the courses and the available courses.
5. Shortcode was created and it displays. THis is the shortcode [fetch_json_data]
6. Bonus points No caching, tried to implement paging failed ad the page numbers didnt appear, No time to create a setting page with a meta field that can be created with a pluging easely with ACF, shortcodes dont fail after deactivating.

   
SECTION 3.

3.1 Explain your approach to optimizing the plugin for a high-traffic e-commerce site (500,000+ monthly visitors, 50.000+ products),

Having a large data base of products you spect to have them well categorize to avoid loading much content to the DOM.
Depending on the needs if you in a home you will only load 4 items in an specific section like recomendations, then add a botton "See more recomendations" take you to another page. That page could have a massive ammoutn of reco, then add a categorization bar, because its necesary to add some filters and additional, will add a load more button, but I prefer a infinite croll loading with ajax. Depending of the grid I will maximun load 9 or 10 items at a time.

Second mostly that loading time depends on the Hosting and how much data can it load at a time. U can optimize as much uu want but if u currently have a hosting with low ram and not a dedicated VPS U some users can have an slow time rendering stuff on the site.

Third, if working with wordpress you need to clean up all the time any loop you create.

3.2 Describe three potential security vulnerabilities specific to e-commerce plugins and how you would address them.

If you have any kind of user registration, must add several security levels, the first one we all know its google recatpcha, this avoids robots to exploid the form submiting multiple requests at a time that leads to a page burn out.
Limit any kind of text fields with character limitation, that helps to void any SQL injection over those fields. Never leave open any text field.
When a user is registering, add a double verification when registering, would be nice to have authenticatior option on login
Keep PHP code up to date.
If the plugin has an admin panel for the user, prevent unathorized users to load by any chance the admin panel. So its important to masively filter the ROL of the registered user to avoid any admin complications.

3.2 How would you ensure this plugin scales effectively as the product catalog and user base grow?

Wel organize structure of files its important, knowing where each function is going to be and what files its calling.
WEll structured variables inside the functions so it can be reused in any new function that is going to be added
Document what each files does.


SUBMISSION GUIDELINES

Installation instructions

1. Donwload testpluging folder as a zip and in that same way go to plugins page on wordpress and install a new pluging uploading it.
2. U can use the [fetch_json_data] shortcode to show data on the front end.

