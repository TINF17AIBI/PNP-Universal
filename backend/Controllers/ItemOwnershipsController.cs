using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PnP_Universal.Models;

namespace PnP_Universal.Controllers
{
    [Produces("application/json")]
    [Route("api/ItemOwnerships")]
    public class ItemOwnershipsController : Controller
    {
        private readonly PnPContext _context;

        public ItemOwnershipsController(PnPContext context)
        {
            _context = context;
        }

        // GET: api/ItemOwnerships
        [HttpGet]
        public IEnumerable<ItemOwnership> GetItemOwnership()
        {
            return _context.ItemOwnership;
        }

        // GET: api/ItemOwnerships/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetItemOwnership([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var itemOwnership = await _context.ItemOwnership.SingleOrDefaultAsync(m => m.Id == id);

            if (itemOwnership == null)
            {
                return NotFound();
            }

            return Ok(itemOwnership);
        }

        // PUT: api/ItemOwnerships/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutItemOwnership([FromRoute] int id, [FromBody] ItemOwnership itemOwnership)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != itemOwnership.Id)
            {
                return BadRequest();
            }

            _context.Entry(itemOwnership).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!ItemOwnershipExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/ItemOwnerships
        [HttpPost]
        public async Task<IActionResult> PostItemOwnership([FromBody] ItemOwnership itemOwnership)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.ItemOwnership.Add(itemOwnership);
            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateException)
            {
                if (ItemOwnershipExists(itemOwnership.Id))
                {
                    return new StatusCodeResult(StatusCodes.Status409Conflict);
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtAction("GetItemOwnership", new { id = itemOwnership.Id }, itemOwnership);
        }

        // DELETE: api/ItemOwnerships/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteItemOwnership([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var itemOwnership = await _context.ItemOwnership.SingleOrDefaultAsync(m => m.Id == id);
            if (itemOwnership == null)
            {
                return NotFound();
            }

            _context.ItemOwnership.Remove(itemOwnership);
            await _context.SaveChangesAsync();

            return Ok(itemOwnership);
        }

        private bool ItemOwnershipExists(int id)
        {
            return _context.ItemOwnership.Any(e => e.Id == id);
        }
    }
}