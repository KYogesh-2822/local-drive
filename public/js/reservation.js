

var pbk = {
  "settings" : {
    "kicker" : "#pbk-widget",
    "contentContainer" : "#pbk-widget2mk",
    "brand" : "ET"
  },
  "listeners":
  {navigateNewStep:t=>{try{window.dataLayer=window.dataLayer||[];const e=t.analyticsData.rate;if(null==e)return;let a=t.analyticsData["location-details"];null==a&&(a={pickupStation:{}});let i=t.analyticsData.reservation;null==i&&(i={});let n=t.analyticsData["dates-and-times"],o=0;n.returnDateTime&&n.pickupDateTime&&(o=n.returnDateTime.toDate().getTime()-n.pickupDateTime.toDate().getTime());const c=e.totalCharge.estimatedTotalAmount,r=e.vehicle;if("upgrades-and-options"===t.id){let m={value:c.total/100,currency:c.currency,pickUpLocationCode:a.pickupStation.code,dropOffLocationCode:a.dropoffStation.code,pickUpLocation:a.pickupStation.name,dropOffLocation:a.dropoffStation.name,pickUpDate:n.pickupDateTime.toISOString(),dropOffDate:n.returnDateTime.toISOString(),lengthOfRental:Math.ceil(o/864e5),contractId:e.contractId,customerType:t.analyticsData.membership?t.analyticsData.membership:"None",payment:e.paymentMethod,country:a.pickupStation.address.country.name,reservationType:i.state,items:[{item_name:r.vehContent.name,item_category:r.vehContent.catCode,item_list_name:"vehicle",price:e.vehicleCharges[0].price.amount/100,quantity:e.vehicleCharges[0].calculation[0].quantity,location_id:a.pickupStation.name,currency:c.currency}]};dataLayer.push({ecommerce:null}),dataLayer.push({event:"select_car",ecommerce:m})}else if("driver-details"===t.id){let i={value:c.total/100,currency:c.currency,pickUpLocationCode:a.pickupStation.code,dropOffLocationCode:a.dropoffStation.code,pickUpLocation:a.pickupStation.name,dropOffLocation:a.dropoffStation.name,pickUpDate:n.pickupDateTime.toISOString(),dropOffDate:n.returnDateTime.toISOString(),lengthOfRental:Math.ceil(o/864e5),contractId:e.contractId,customerType:t.analyticsData.membership?t.analyticsData.membership:"None",payment:e.paymentMethod,country:a.pickupStation.address.country.name,items:[{item_name:r.vehContent.name,item_category:r.vehContent.catCode,price:e.vehicleCharges[0].price.amount/100,quantity:e.vehicleCharges[0].calculation[0].quantity,item_list_name:"vehicle",location_id:a.pickupStation.name,currency:c.currency}].concat(function(t){const e=t.filter((t=>1===t.quantity)),a=[];for(let t of e)a.push({item_name:t.code,item_category:"extras",item_category2:"coverage",item_category3:t.type,price:t.totalPrice.amount/100,quantity:t.quantity});return a}(e.coverages)).concat(function(t){const e=t.filter((t=>1===t.quantity)),a=[];for(let t of e)a.push({item_name:t.code,item_category:"extras",item_category2:"equipment",item_category3:t.type,price:t.totalPrice.amount/100,quantity:t.quantity});return a}(e.equipments))};dataLayer.push({ecommerce:null}),dataLayer.push({event:"select_extras",ecommerce:i})}}catch(t){console.error(t)}},reservationCompleted:t=>{try{window.dataLayer=window.dataLayer||[];const e=t.analyticsData.rate;if(null==e)return;let a=t.analyticsData["location-details"];null==a&&(a={pickupStation:{}});const i=e.totalCharge.estimatedTotalAmount,n=e.vehicle;let o=t.analyticsData.reservation;null==o&&(o={});let c=t.analyticsData["dates-and-times"],r=0;c.returnDateTime&&c.pickupDateTime&&(r=c.returnDateTime.toDate().getTime()-c.pickupDateTime.toDate().getTime());let m={value:i.total/100,currency:i.currency,pickUpLocationCode:a.pickupStation.code,dropOffLocationCode:a.dropoffStation.code,pickUpLocation:a.pickupStation.name,dropOffLocation:a.dropoffStation.name,pickUpDate:c.pickupDateTime.toISOString(),dropOffDate:c.returnDateTime.toISOString(),lengthOfRental:Math.ceil(r/864e5),contractId:e.contractId,customerType:t.analyticsData.membership?t.analyticsData.membership:"None",payment:e.paymentMethod,country:a.pickupStation.address.country.name,reservationNumber:t.confirmationNumber,items:[{item_name:n.vehContent.name,item_category:n.vehContent.catCode,item_list_name:"vehicle",price:e.vehicleCharges[0].price.amount/100,quantity:e.vehicleCharges[0].calculation[0].quantity,location_id:a.pickupStation.name,currency:i.currency}].concat(function(t){const e=t.filter((t=>1===t.quantity)),a=[];for(let t of e)a.push({item_name:t.code,item_category:"extras",item_category2:"coverage",item_category3:t.type,price:t.totalPrice.amount/100,quantity:t.quantity});return a}(e.coverages)).concat(function(t){const e=t.filter((t=>1===t.quantity)),a=[];for(let t of e)a.push({item_name:t.code,item_category:"extras",item_category2:"equipment",item_category3:t.type,price:t.totalPrice.amount/100,quantity:t.quantity});return a}(e.equipments))};dataLayer.push({ecommerce:null}),dataLayer.push({event:"reservation_complete",ecommerce:m})}catch(t){console.log("PBK GTM Plugin"),console.error(t)}}}

};

(function(){
    var widgetRoot=document.querySelector('#pbk-widget');

    if(!widgetRoot){
      return;
    }

    var normalizeLoadingHeading=function(root){
      var headings=[];

      if(root && root.nodeType===1 && root.matches('h1.enterprise-pbk-loading-text')){
        headings.push(root);
      }

      if(root && root.querySelectorAll){
        headings=headings.concat(Array.from(root.querySelectorAll('h1.enterprise-pbk-loading-text')));
      }

      headings.forEach(function(heading){
        var replacement=document.createElement('div');

        Array.from(heading.attributes).forEach(function(attribute){
          replacement.setAttribute(attribute.name,attribute.value);
        });
        replacement.innerHTML=heading.innerHTML;
        heading.replaceWith(replacement);
      });
    };

    normalizeLoadingHeading(document);

    if(window.MutationObserver){
      var headingObserver=new MutationObserver(function(mutations){
        mutations.forEach(function(mutation){
          mutation.addedNodes.forEach(function(node){
            normalizeLoadingHeading(node);
          });
        });
      });
      headingObserver.observe(document.body,{childList:true,subtree:true});
    }

    if(document.querySelector('script[src*="widget-cdn.partnerbookingkit.com"]')){
      return;
    }

    var d=document,
    l=d.createElement('link'),
    s=d.createElement('script'),
    u='https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4123d9/widget.';
    l.href=u+'css';
    l.rel='stylesheet';
    d.head.appendChild(l);
    s.src=u+'js';
    s.async=true;d.head.appendChild(s)
    })();


      $(window).on('load',function(){
        $('#enterprise-pbk').addClass('form-checked');
      });

