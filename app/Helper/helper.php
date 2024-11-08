<?php


/**
 * calculate discount percent
 */
function calculateDiscountPercent($originalPrice, $discountPrice){
    
    // $discountAmount = ($originalPrice - $discountPrice);
    // return $discountAmount;
    // $discountPercent = ($discountAmount / $originalPrice) * 100;
    // $discountPercent = ($originalPrice/ $discountAmount) * 100;
    // return $discountPercent;

    //alternative: 
    $discountPercent = ($discountPrice / $originalPrice) * 100;
    return round($discountPercent);
}

/**
 * limit text 
 */
function limitText($text, $limit=20){
    return \Str::limit($text, $limit);
}