// JavaScript functionality for adding items to the cart
const addToCartButtons = document.querySelectorAll('.add-to-cart');

addToCartButtons.forEach(button => {
  button.addEventListener('click', () => {
    const product = button.parentNode;
    const productName = product.querySelector('h3').textContent;
    const productPrice = product.querySelector('p').textContent;

    // Here you can add functionality to add the product to the cart
    // For demonstration, displaying the product details in the console
    console.log(`Added to Cart: ${productName} - Price: ${productPrice}`);
  });
});
