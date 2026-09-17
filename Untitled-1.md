 I reviewed all eight documents. This is not only a content upload—it requires new page development, SEO implementation, content cleanup, and publishing.

  ## Deliverables

  1. Update the homepage using the supplied homepage brief
     (https://imarkinfotechseo-my.sharepoint.com/:w:/g/personal/tanu_bansal_imarkinfotech_com/IQDtTZsHwC_bS4LeSq0dD5W4AUuNkaFh69oSQWuVGWG5rlg?e=FdIuRM).

  2. Create four SEO location pages:
      - /locations/car-rental-aqaba-airport
      - /locations/car-rental-amman-airport
      - /locations/car-rental-amman
      - /locations/car-rental-aqaba

  3. Publish three blog articles:
      - Complete Guide to Car Rental in Jordan for First-Time Visitors (https://clientsreporting.com/public-doc/25063be83821d5a05e2c6039f3b90dfa2cc1d2d4a41ee467a2cad3afbdd6d53c)
      - Is Renting a Car in Jordan Worth It Compared to Public Transport? (https://clientsreporting.com/public-doc/91e56996885e93ec6883656cbdb72246f7ed394ff3dad7087a4e7a9444951b9b)
      - Family Car Rental in Jordan: Best Vehicles for Your Trip (https://clientsreporting.com/public-doc/f0c7d025cbfef448c33cb66aad876c74f3e3db7d53301838f06129d3033f2a19)

  A blog listing page such as /blog is also recommended, although it was not explicitly requested.

  ## Development required from our side

  - Build a reusable location landing-page template.
  - Add the reservation widget to the new pages.
  - Implement sections for fleet types, benefits, locations/attractions, rental requirements, booking process, blogs, CTA and FAQs.
  - Connect “View All Vehicles,” reservation and contact buttons to the correct pages.
  - Build a blog article template and preferably a blog management system.
  - Add the three blogs to homepage/location-page blog sections.
  - Make all pages responsive and consistent with the existing Enterprise design.
  - Add the new URLs to navigation/internal links and sitemap.xml.
  - Test booking links, mobile layout, images, FAQs and 404 handling.

  ## SEO work required

  The current layout uses one hard-coded title and duplicate description across the website in /C:/xampp/htdocs/ENTERPRICE/enterprise-project/resources/views/layouts/links.blade.php:2 and /C:/xampp/
  htdocs/ENTERPRICE/enterprise-project/resources/views/layouts/main.blade.php:10. We need to introduce page-specific:

  - Meta title and description
  - Canonical URL
  - Open Graph and Twitter tags
  - Breadcrumb schema
  - FAQPage schema
  - BlogPosting schema for articles
  - Correct H1/H2/H3 structure
  - Image alt text
  - Internal linking without unnecessary nofollow

  The generated schema inside the blog documents should be rebuilt because its word counts and FAQs do not consistently match the visible articles.

  ## Content and image processing

  - Proofread approximately 9,500 words of supplied content.
  - Remove the “Meta Title,” “Meta Description” and “Slug” instruction lines from the visible articles.
  - Correct spacing, grammar and inconsistent UK/US spelling.
  - Fix Blog 3’s multiple-H1 structure.
  - Remove the unrelated “business formation law firm” sentence from Blog 1 unless specifically approved.
  - Download and locally host the three supplied blog images.
  - Convert/compress the blog images—the supplied PNGs are approximately 2.5–2.9 MB each.
  - Obtain approved images for the homepage and location pages; the five Word documents contain no embedded image assets.

  ## Client confirmations needed before publishing

  1. The Aqaba Airport brief repeatedly uses “Arena Rent a Car at Aqaba Airport.” Confirm whether this competitor/keyword wording must be removed and replaced with Enterprise.
  2. Confirm these operational statements:
      - Minimum rental age is generally 25
      - International Driving Permit is not required
      - Daily rentals are fully insured
      - One-way returns are available
      - Child seats are available

  3. Confirm that all mentioned offices actually exist:
      - Amman City Mall
      - Ash Shumaysani
      - Al Sweifieh
      - Aqaba City Centre
      - Aqaba Corniche
      - Both airport locations

  4. Confirm blog URL structure: root-level slugs or /blog/{slug}.
  5. Provide/approve:
      - Blog author, category and publication date
      - CTA button labels and destinations
      - Location/homepage imagery
      - Final meta titles where the document fields conflict

  ## Current project status

  All four requested location URLs and all three proposed blog URLs currently return 404. The repository has no blog routes or article module; it only has editable homepage blog cards in /C:/xampp/
  htdocs/ENTERPRICE/enterprise-project/resources/views/index.blade.php:139. Therefore, this should be treated as a development task, not only an admin content-entry task.