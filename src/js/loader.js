document.title = collectionInfo.name;
document.getElementById("favicon").href = `./assets/${collectionInfo.medias.favicon}`;
document.getElementById("price-img").src = `./assets/${collectionInfo.medias.preview}`;

document.getElementById("titleH4").innerText = customStrings.title.replace("{name}", collectionInfo.name);
document.getElementById("totalSupply").innerText = `: ${mintInfo.totalSupply.toLocaleString()}`;
document.getElementById("nftPrice").innerText = `${mintInfo.price.toFixed(2)}`;
document.getElementById("dateString").innerText = customStrings.dateString.replace("{date}", collectionInfo.date);

// Remover a linha relacionada à geração de números
// document.getElementById("nftsNumber").innerText = `${mintInfo.minUnits}`;


switch (collectionInfo.background.type) {
    case "video":
        document.getElementById("background-video").poster = `./assets/${collectionInfo.background.image}`;
        document.getElementById("background-video-source").src = `./assets/${collectionInfo.background.video}`;
        document.getElementById("background-video").load();
        break;
    case "image":
        document.getElementById("background-video").outerHTML = '';
        const imageStyle = `<style> .body { background-image: url('./assets/${collectionInfo.background.image}'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: center } </style>`;
        document.head.insertAdjacentHTML('beforeend', imageStyle);
        break;
    case "color":
        document.getElementById("background-video").outerHTML = '';
        document.head.insertAdjacentHTML('beforeend', `<style> body { background-color: ${collectionInfo.background.color} } </style>`);
        document.getElementsByClassName('content')[0].style.backgroundColor = collectionInfo.background.color;
        break;
    default:
        console.error(`Error: ${collectionInfo.background.type} is not supported\nPlease use one of the supported background types: image, video, color`);
        break;
}

if (collectionInfo.socialMedia.discord == "") {
    document.head.insertAdjacentHTML('beforeend', '<style> #social_discord { opacity: 0.5; pointer-events: none; } </style>');
} else document.getElementById("social_discord").href = collectionInfo.socialMedia.discord;
if (collectionInfo.socialMedia.twitter == "") {
    document.head.insertAdjacentHTML('beforeend', '<style> #social_twitter { opacity: 0.5; pointer-events: none; } </style>');
} else document.getElementById("social_twitter").href = collectionInfo.socialMedia.twitter;

