
let name = document.querySelector('.name');
let dis = document.querySelector('.dis');
let logotext= document.querySelector('.logotext');
let serviceImage = document.querySelector('.service-image');

const params = new URLSearchParams(window.location.search);
const service = params.get('service');


if (service === "electronic") {
   
    name.textContent = "Electronic Device Repair";
    dis.textContent = "We offer comprehensive repair services for all types of electronic devices, including smartphones, laptops, desktops, televisions, and tablets. Our highly skilled and experienced technicians are dedicated to diagnosing and resolving a wide range of issues, ensuring that your devices are restored to peak performance. We specialize in screen and battery replacements, water damage repair, hardware upgrades, virus and malware removal, data recovery, and operating system optimization. Additionally, we provide software updates, firmware installations, and preventative maintenance to prolong the lifespan of your devices.At the core of our service is a commitment to quality and reliability. We use only high-quality replacement parts to ensure long-lasting repairs and enhanced performance. Whether you're dealing with a minor malfunction or a complex technical issue, our team is equipped to deliver innovative solutions tailored to your needs. By choosing us, you can trust that your devices are in expert hands and will be restored to their best condition quickly and efficiently.";
    serviceImage.src = "../imge/imge1.jpg"; 
    serviceImage.alt = "Electronic Device Repair";

} 

else if (service === "maintenance") {
    
    name.textContent = "Home Maintenance Services";
    dis.textContent = "We offer a comprehensive range of home maintenance services designed to meet all your household needs, ensuring that your living space remains in top condition. Our skilled team specializes in a variety of essential services, including plumbing, air conditioning installation and repair, electrical work, and home painting. Whether you're dealing with leaky pipes, need a new air conditioning system, require electrical repairs, or want to refresh your home's appearance with a fresh coat of paint, we've got you covered. Our goal is to provide reliable, efficient, and high-quality services that enhance the functionality and comfort of your home. We take pride in delivering exceptional results while ensuring safety, durability, and customer satisfaction. With our expertise, we can help prevent future issues, saving you time and money in the long run. Trust us to take care of your home, providing expert solutions tailored to your specific needs.";
    serviceImage.src = "../imge/imge2.jpg"; 
    serviceImage.alt = "Home Maintenance Services";
}

else if (service === "mechanical") {
    
    name.textContent = "Mechanical Services";
    dis.textContent = "Our mechanical services cover a wide range of maintenance and repair solutions for cars and motorcycles, ensuring that your vehicles remain in peak performance. We specialize in routine maintenance, such as oil changes, brake inspections, tire replacements, and engine diagnostics. In addition, we offer fast and reliable repairs for any mechanical faults your vehicle may encounter. Whether it's addressing engine issues, transmission problems, or suspension repairs, our experienced technicians use the latest equipment and technology to provide accurate diagnostics and effective solutions. We prioritize both the safety and longevity of your vehicle, offering high-quality services to get you back on the road as quickly as possible. With our commitment to precision and customer satisfaction, we ensure that your car or motorcycle operates smoothly and efficiently.";
    serviceImage.src = "../imge/imge3.jpg"; 
    serviceImage.alt = "Mechanical Services";
} 

else if (service === "real") {
  
    name.textContent = "Real Estate Services";
    dis.textContent = "Our real estate services are designed to meet all your property needs, whether you're looking to buy, sell, or rent. We offer a wide range of professional services to help you navigate the complexities of the real estate market with confidence. Whether you're in search of your dream home, looking for investment opportunities, or seeking to sell or rent out your current property, our experienced team is here to guide you through each step of the process. In addition to buying, selling, and renting, we provide expert real estate consultations tailored to your specific needs, helping you make well-informed decisions. We carefully analyze the market to present the best available options that match your budget, preferences, and long-term goals. Whether you're a first-time homebuyer, a seasoned investor, or someone looking to relocate, we offer personalized solutions that prioritize your satisfaction. With our extensive market knowledge, attention to detail, and commitment to delivering excellent customer service, we ensure that your real estate journey is as smooth, efficient, and successful as possible. Our goal is to help you find the perfect property and make the process seamless, allowing you to achieve your real estate objectives with ease.";
    serviceImage.src = "../imge/imge4.jpg"; 
    serviceImage.alt = "Real Estate Services";
}

else if (service === "1") {

 
    name.textContent = "Project Overview";
    dis.textContent ="The web platform is an innovative solution aimed at bridging the gap between skilled graduates and clients who require services such as repairs, maintenance, and other specialized tasks. Graduates who possess technical or manual skills often face challenges in launching their own businesses due to financial constraints. This platform seeks to eliminate those barriers by offering them a space to connect with potential clients and gain work experience without the need for significant capital investment. Through the platform, graduates can create profiles that highlight their skills and expertise, allowing clients to easily find and hire them for specific jobs. The platform also provides businesses or individuals with the opportunity to rent advertising space to promote their services, enhancing visibility and attracting potential customers. By fostering a marketplace where skilled graduates can gain practical experience and build their careers, the platform not only helps them achieve professional growth but also contributes to reducing unemployment among young graduates. Additionally, the platform creates a network of service providers that ensures clients can access reliable, high-quality services at competitive rates. Ultimately, this project aims to empower graduates, stimulate local economies, and offer a sustainable solution to the challenges faced by skilled professionals in the early stages of their careers.";
    serviceImage.src = "../imge/protfolio.jpg"; 
    serviceImage.alt = "Project overview";
}
else if (service === "2") {

  
    name.textContent = "The Problem";
    dis.textContent ="Despite possessing valuable skills in trades such as electrical work, plumbing, mechanics, and other specialized areas, many graduates face significant barriers that prevent them from fully capitalizing on their expertise. One of the primary challenges is the lack of financial resources to start their own businesses. While these graduates are equipped with the technical knowledge and hands-on experience needed for their trade, they often find themselves unable to invest in the essential tools, equipment, or even the marketing required to establish a business. Additionally, without a strong network or mentorship, these skilled individuals can struggle to find clients or navigate the complexities of running a small business. Furthermore, traditional job markets may not always have the capacity to absorb such skilled workers, leaving them with limited employment options. In many cases, graduates are forced to take on jobs that do not align with their training or qualifications, leading to underemployment. This situation is particularly challenging in areas with high unemployment rates or limited opportunities for entrepreneurship, where graduates are left with few ways to use their skills for financial independence or career advancement.";
    serviceImage.src = "../imge/protfolio-2.jpg"; 
    serviceImage.alt = "The Problem";
}
else if (service === "3") {

    name.textContent = "The Solution";
    dis.textContent ="The solution to this problem is a web platform that empowers skilled graduates to offer their services directly to clients, bypassing the need for significant financial investment or the complexities of starting a traditional business. By providing a user-friendly and accessible marketplace, the platform allows graduates to showcase their skills and expertise in areas such as electrical work, plumbing, mechanics, and more. This enables them to build a reputation, gain experience, and start generating income by taking on projects or tasks that align with their abilities.The platform also offers a unique opportunity for service providers, including businesses or independent professionals, to rent space for promoting their services. This feature allows providers to reach a wider audience, enhancing their visibility and attracting potential clients without the need for expensive advertising campaigns. Through the platform, service providers can create detailed profiles, display their qualifications, and even set their own rates, giving them control over how they present themselves to the market. By removing the barriers to entry typically associated with starting a business, such as high upfront costs and the need for business infrastructure, the platform creates a level playing field for skilled graduates. It offers them a cost-effective way to enter the workforce, gain practical experience, and establish themselves in their chosen fields. At the same time, it provides clients with access to a diverse pool of skilled professionals, ensuring that their service needs are met with high-quality, affordable options. Ultimately, this solution fosters career growth, job creation, and economic empowerment for graduates, while also benefiting clients who are seeking reliable, skilled workers.";
    serviceImage.src = "../imge/protfolio-3.jpg"; 
    serviceImage.alt = "The Solution";
}
else {
    
    dis.textContent = "The selected service does not exist or is unavailable.";
    serviceImage.src = "https://example.com/notfound.jpg"; 
    serviceImage.alt = "Service Not Found";
}

