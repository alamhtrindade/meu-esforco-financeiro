DO $$
BEGIN
	ALTER TABLE task.status ADD COLUMN active BOOLEAN;
    INSERT INTO task.status(name, active) VALUES ('Pending', true);
    INSERT INTO task.status(name, active) VALUES ('Completed', true);
END $$;