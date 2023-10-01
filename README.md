# Magic Test Case App

## Pre Initialization
Add row in file /etc/hosts
```text
127.0.0.1       magicproject.loc
```
or run command
```bash
sudo sh -c "echo \"127.0.0.1       magicproject.loc\" >> /etc/hosts"
```

## Initialization
```bash
$ make init
```

These command run app completely with webserver and database

## Routes with UI
```text
/test/1 - Show test with id = 1
/result/{id} - Show test result with {id} = uuid
```

## Additional
If you want use roadrunner then uncomment roadrunner section in [docker-compose.yml file](docker-compose.yml)

## Credits

- [Dmitrii Denisov][link-author]

## License

"Magic Test Case" is software licensed under the [MIT License](LICENSE).

[link-author]: https://github.com/dda58
