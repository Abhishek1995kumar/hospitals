import { useEffect, useState } from "react";

export default function FlashMessage({ message }) {
    const [show, setShow] = useState(true);
    useEffect(() => {
        const timer = setTimeout(() => {
            setShow(false);
        }, 3000);

        return () => clearTimeout(timer);

    }, []);

    if (!message || !show) {
        return null;

    }

    return (
        <div className="mb-5 bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded">
            {message}
        </div>
    );
}