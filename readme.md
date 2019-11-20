# EoneoPay PHP SDK

## Transactions

The status of the transaction can be determined using the state property. There are situations where a transaction can
 be approved or completed but reversed at a later time. The state property is the only way to determine the actual state
 of the transaction. A table listing the meaning of each of the state field values is below.

| Value | State | Description |
|-------|-------| ----------- |
| 1     | Pending | Request received, pending processing |
| 2     | Processing | Request is being processed |
| 10    | Provisionally approved | May be reversed, but funds could be available after clearing |
| 11    | Approved | Funds will be available after clearing |
| 90    | Failed/reversed/declined | Funds could not be transferred, and are not available |
| 80    | Finalised/cleared | Funds have transferred to destination are available |

## Development

Main repository: https://github.com/loyaltycorp/eoneopay-phpsdk

### Adding Entities

Entities are the class types the SDK exposes for serialising before sending to payments in JSON form, and the
class type the responses are de-serialised to on response.

Entities are in the `src/Endpoints` directory, under the `EoneoPay\PhpSdk\Endpoints` namespace.

#### URIS

URIs list the acceptable actions that can be performed against with a given entity. These can be accessed
 programmatically by calling the `uris()` method on an entity instance.

#### Entity Serialisation / @Groups

The `@Groups` annotation indicates the which fields which will be serialised before being sent as JSON. The
 annotation uses `Symfony\Component\Serializer\Annotation\Groups`.

In the following example, the `$actionUrl` would be serialised when being sent to payments for both `create` and
 `update` calls, but `$amount` will only be sent for the initial `create` call.


```php
use Symfony\Component\Serializer\Annotation\Groups;
trait SecurityTrait
{
    /**
     * @Groups({"create", "update"})
     */
    protected $actionUrl;

    /**
     * @Groups({"create"})
     */
    protected $amount;
```

The `@Groups` annotations can be used on the same fields as `@Assert` annotations below.

#### Entity Deserialisation / Validation

Validation is applied to the JSON responses from payments to ensure that the returning fields are valid.

In the following examples, `$id` must be a string, which can't be null. `$ewallet` must be  de-serialisble to a a valid
 object of the type Ewallet.

Note that the `@var` annotation is used to discover the entity type that the contents of `$ewallet` should be
  de-serialised to.

```php
use Symfony\Component\Validator\Constraints as Assert;
trait EwalletFundingTrait
{
    /**
     * @Assert\NotNull()
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\Ewallet")
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;

    /**
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * @var string|null
     */
    protected $id;
```
