DELETE FROM users WHERE expirate_token < NOW() - INTERVAL '14 DAY';
