
export function generateRandomHexColor() : string {
    return  `#${Math.floor(Math.random() * 0xFFFFFFFF).toString(16).padStart(6, '0').toUpperCase()}`
}
