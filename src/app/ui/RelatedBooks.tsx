import React from 'react';
import AnnonceCard from './AnnonceCard';
import { getSameAuthor } from '@/app/lib/annonces';

interface RelatedBooksProps {
    author: string;
    currentProductId: string;
}

const RelatedBooks: React.FC<RelatedBooksProps> = ({ author, currentProductId }) => {
    const [relatedBooks, setRelatedBooks] = React.useState([]);

    React.useEffect(() => {
        const fetchRelatedBooks = async () => {
            const books = await getSameAuthor(author);
            setRelatedBooks(books.filter((book) => book.id !== currentProductId));
        };

        fetchRelatedBooks();
    }, [author, currentProductId]);

    return (
        relatedBooks.length === 0 ? null : (
            <section className="related-books">
            <h2>Books by the same author</h2>
            <div className="related-books-list">
                {relatedBooks.map((book) => (
                <AnnonceCard key={book.id} annonce={book} />
                ))}
            </div>
            </section>
        )
    );
};

export default RelatedBooks;