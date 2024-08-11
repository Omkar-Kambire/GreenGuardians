
CREATE TABLE `addresses` (
  `order_id` int NOT NULL,
  `user_ID` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postalcode` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL
)





CREATE TABLE `cart_details` (
  `product_id` int NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int NOT NULL
);







CREATE TABLE `categories` (
  `cID` int NOT NULL,
  `cTitle` varchar(30) NOT NULL,
  `cDesc` varchar(60) NOT NULL
);



INSERT INTO `categories` (`cID`, `cTitle`, `cDesc`) VALUES
(1, 'Fertilizers', 'It includes various types of fertilizers.'),
(2, 'Pesticides', 'It includes various types of fertilizers\r\n');



CREATE TABLE `orders_pending` (
  `order_id` int NOT NULL,
  `user_ID` int NOT NULL,
  `invoice_number` int NOT NULL,
  `pID` int NOT NULL,
  `quantity` int NOT NULL,
  `order_status` varchar(255) NOT NULL
);






CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `razorpay_order_id` varchar(50) DEFAULT NULL,
  `razorpay_payment_id` varchar(50) DEFAULT NULL
);







CREATE TABLE `products` (
  `pID` int NOT NULL,
  `pName` varchar(200) NOT NULL,
  `pDesc` varchar(3000) NOT NULL,
  `pKeywords` varchar(255) NOT NULL,
  `cID` int NOT NULL,
  `pPhoto` varchar(255) NOT NULL,
  `pPrice` varchar(100) NOT NULL,
  `pQuantity` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL
);




INSERT INTO `products` (`pID`, `pName`, `pDesc`, `pKeywords`, `cID`, `pPhoto`, `pPrice`, `pQuantity`, `date`, `status`) VALUES
(1, 'Cocopeat Block', 'Made of the inner fibres of coconut, coco peat is lightweight, well draining and retains moisture for longer without getting water logged.', 'cocopeat,Coco, Cocopeat', 1, '1-kg-cocopeat-block-32180447608964.jpg', '345', 30, '2024-04-01 19:16:13', 'true'),
(2, 'Cow Manure', 'Ugaoo Cow Manure is an excellent fertilizer rich in organic matter that helps to improve aeration and the breaking up of compact soils.', 'Ugaoo, Manure,organic', 1, '5-kg-cow-manure-31256517378180.jpg', '550', 25, '2024-04-01 19:16:37', 'true'),
(3, 'Vermicompost', 'Vermicompost is made by breaking down the organic material through the use of worms. Vermicompost improves biological, chemical, and physical properties of the soil.', 'Vermicompost, organic , compost', 1, '5-kg-vermicompost-31258231996548.jpg', '660', 30, '2024-04-01 19:21:15', 'true'),
(4, 'Neem Cake Powder - 1 kg', 'Made of dehydrated neem leaves, kernels, and bark, the neem cake powder works as an organic fertiliser with various micro and macro nutrients.', 'neem, cake powder', 1, 'neem-cake-powder-1-kg-31730858786948.jpg', '780', 40, '2024-04-01 19:21:46', 'true'),
(5, 'Plantic Superkiller 25', 'Plantic Total Plant Care 3 in 1 Dosage: 3ML to 5ML in 1 Litre of water and spray on the plants. For better results, use after every 7 days.', 'Plantic , fungicide , miticide', 2, 'shopping.jpg', '930', 45, '2024-04-01 19:25:51', 'true'),
(6, 'Tata Rallis Tafgor Dimethoate 30% EC Insecticide', '1. Tafgor is highly effective in controlling the sucking and caterpillar pests. 2. It is highly compatible with other insecticides and fungicides.', 'Tata, tata, tafgor , insecticide', 2, 'TafgorInsecticide-bharatAgriKrushidukan.jpg', '880', 30, '2024-04-01 13:54:01', 'true'),
(7, 'Humesol Humesol_100ml Pesticide', 'Brand Is Humesol. Form Factor Is Liquid. Type Is Pesticide. Net Quantitys Is 500 Ml. Model Name Is Humesol_100ml. Container Type Is Bottle.', 'Pesicide , humesol', 2, 'total-plant-care1.jpg', '870', 40, '2024-04-01 19:22:55', 'true'),
(8, 'Dhanuka SuperKiller 25% EC', 'MODE OF ACTION Superkiller controls the insects by its contact and stomach poison action.It can be applied as a foliar spray.', 'Dhanuka , superkiller', 2, 'dhanuka.jpg', '790', 20, '2024-04-01 19:23:24', 'true');


CREATE TABLE `user` (
  `user_ID` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_pic` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_address` varchar(300) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_type` enum('user','admin') NOT NULL DEFAULT 'user'
);



INSERT INTO `user` (`user_ID`, `user_name`, `user_email`, `user_password`, `user_pic`, `user_ip`, `user_address`, `user_phone`, `user_type`) VALUES
(1, 'Omkar', 'omkar@gmail.com', '123456', 'Pune.jpg', '::1', 'Karad', '9876543210', 'user'),
(2, 'Paddy', 'paddy@gmail.com', '123456', 'Pune.jpg', '::1', 'Karad', '9876543210', 'admin'),
(3, 'Satish', 'satish@gmail.com', '123456', 'Shree_Ram.jpg', '::1', 'Karad', '9876543210', 'user');



CREATE TABLE `user_orders` (
  `order_id` int NOT NULL,
  `user_ID` int NOT NULL,
  `amount_due` int NOT NULL,
  `invoice_number` int NOT NULL,
  `total_products` int NOT NULL,
  `order_date` timestamp NOT NULL,
  `order_status` varchar(255) NOT NULL
);




ALTER TABLE `addresses`
  ADD PRIMARY KEY (`order_id`);


ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);


ALTER TABLE `categories`
  ADD PRIMARY KEY (`cID`);


ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);


ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`pID`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);


ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);


ALTER TABLE `addresses`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `categories`
  MODIFY `cID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `orders_pending`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `products`
  MODIFY `pID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `user`
  MODIFY `user_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `user_orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;


